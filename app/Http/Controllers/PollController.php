<?php

namespace App\Http\Controllers;

use App\Events\VoteStoredEvent;
use App\Models\Choice;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function getAll()
    {
        // $poll_datas = Poll::with(array('users' => function($query) {
        //     $query->select('name');
        // }))->get();
        $poll_datas = Poll::with(['users' => function($query) {
            $query->select('id','name');
        }])->get();
        return view('poll.list-poll', compact('poll_datas'));
    }

    public function getChoice($id)
    {
        $poll = Poll::find($id);
        $author = $poll->users;
        $choices = $poll->choices;
        return [
            'poll' => $poll,
            'author' => $author[0],
            'choices' => $choices
        ];
    }

    public function getVoteHistory($id)
    {
        $poll = Poll::find($id);
        $choices = $poll->choices;
        $votes = [];
        foreach ($choices as $choice) {
            $vote = Vote::where('choice_id',$choice->id)->join(
                'users', 'respondent_id', '=', 'users.id'
            )->get(
                ['votes.*', 'users.name as respondent_name']
            );
            foreach ($vote as $vot) {
                array_push($votes, $vot);
            }
        }

        return compact('votes');
    }

    public function make(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'choice' => 'required'
        ]);
        $poll = Poll::create([
            'author_id' => auth()->user()->id,
            'title' => request('title'),
        ]);
        if($poll) {
            foreach (request('choice') as $key => $value) {
                Choice::create([
                    'poll_id' => $poll->id,
                    'value' => $value
                ]);
            }
            return redirect('/polls/'.$poll->id);
        }
        return redirect('home');
    }

    public function showPoll($id)
    {
        $history = $this->getVoteHistory($id);
        $current_poll = $this->getChoice($id);
        foreach ($history['votes'] as $vote) {
            if ($vote && $vote->respondent_id == auth()->user()->id) {
                $current_poll['poll']->hasVoted = true;
            }
        }
        $isAdmin = auth()->user()->hasRoles('admin');
        return view('poll.poll-choice', compact('current_poll', 'history', 'isAdmin'));
    }
    
    public function vote(Request $request, $id)
    {
        $request->validate([
            'choice' => 'required'
        ]);
        $choice = Choice::find(request('choice'));
        if ($choice) {
            $past_choice = Vote::where([
                'respondent_id' => auth()->user()->id,
                'choice_id' => request('choice')
            ])->get();
            if (!count($past_choice)) {
                $vote = Vote::create([
                    'respondent_id' => auth()->user()->id,
                    'choice_id' => request('choice')
                ]);
                broadcast(new VoteStoredEvent($vote, $id));
            }
        }
        if (Poll::find($id) != null) {
            return $this->showPoll($id);
        }
        return redirect('home');
    }

    public function closeSwitch(Request $request, $id)
    {
        $request->validate([
            'close' => 'required'
        ]);
        if (($poll=Poll::find($id)) != null) {
            $poll->update([
                'closed' => request('close')? true : false
            ]);
        }
        return redirect()->back();
    }
}

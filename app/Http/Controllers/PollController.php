<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function getAll()
    {
        return Poll::get();
    }

    public function getChoice(Request $request, $id)
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

    public function getVoteHistory(Request $request, $id)
    {
        $poll = Poll::find($id);
        $choices = $poll->choices;
        $votes = [];
        foreach ($choices as $choice) {
            foreach ($choice->votes as $vote) {
                $vote->users;
                array_push($votes, $vote);
            }
        }

        return compact('votes');
    }

    // public function newPoll(Request $request)
    // {
    //     $poll = Poll::create([
    //         'author_id' => auth()->user()->id,
    //         'title' => request('title')
    //     ]);

    //     $choice = request('choices');
    // }
}

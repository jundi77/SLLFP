<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollingTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function seeds()
    {
        $poll = Poll::create([
            'author_id' => auth()->user()->id,
            'title' => 'test',
        ]);
        $choice = Choice::create([
            'poll_id' => $poll->id,
            'value' => 'testing!'
        ]);
        $vote = Vote::create([
            'respondent_id' => auth()->user()->id,
            'choice_id' => $choice->id
        ]);
    }

    public function show()
    {
        dd(
            Vote::first()->choices
        );
    }
}

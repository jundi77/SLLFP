<?php

namespace App\Events;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteStoredEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $vote, $poll_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vote $vote, $poll_id)
    {
        $this->poll_id = $poll_id;
        $this->vote = $vote;
    }

    public function broadcastWith()
    {
        $this->vote['respondent_name'] = User::find($this->vote->respondent_id, 'name')['name'];
        return [
            'data' => $this->vote
        ];
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('vote-channel-'.$this->poll_id);
    }
}

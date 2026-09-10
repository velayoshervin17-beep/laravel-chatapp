<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerJoined implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public $code;
    public $participant;
    public $chatMessage;


    /**
     * Create a new event instance.
     */
    public function __construct($code, $participant, $chatMessage)
    {
        $this->code = $code;
        $this->participant = $participant;
        $this->chatMessage = $chatMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('lobby.' . $this->code);
    }

    public function broadcastWith()
    {
        return [
            'participant' => $this->participant,
            'message' => "{$this->participant} has joined the lobby."
        ];
    }

    public function broadcastAs()
    {
        return 'lobby.events-joined';
    }   
}

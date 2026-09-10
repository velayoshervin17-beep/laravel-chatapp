<?php

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Fluent;

class LobbyActivityEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $code;
    public $message;
    public $sender;
    public $messageType;
    public $timestamp;


   // public $participant;
    /**
     * Create a new event instance.
     */
    public function __construct(FLuent  $chatMessage)
    {
        $this->code = $chatMessage->code;
        $this->message = $chatMessage->message;
        $this->sender =  $chatMessage->sender;
        $this->messageType = $chatMessage->messageType;
        $this->timestamp = now()->toIso8601String();
    }



        //      $chatMessage = [
        // 'code' => $code,
        // 'message'=> "{$participant} has joined the lobby.",
        // 'sender' => '[System]',
        // 'message_type' => 'event'
        // ];



    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('lobby.' . $this->code);
    }

    public function broadcastAs()
    {
        return 'lobby.activity';
    }
}

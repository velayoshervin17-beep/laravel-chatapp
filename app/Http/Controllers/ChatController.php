<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\LobbyActivityEvent;
use Illuminate\Support\Fluent;

class ChatController extends Controller
{

    public function allChatMessages(String $code)
    {
        return ChatMessage::where('code', $code)
            ->get();
    }

    public function storeChatMessage(Request $request, String $code)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'sender' => 'required|string|max:255'
        ]);

        


        $participant = $request->input('sender');

        $chatMessage = new ChatMessage();
        $chatMessage->code = $code;
        $chatMessage->message = $request->input('message');
        $chatMessage->sender = $request->input('sender');
        $chatMessage->message_type = "chat";
        $chatMessage->save();

        //     $chatToBroadcast = [
        //     'code' => $code,
        //     'message' => "{$participant} has joined the lobby.",
        //     'sender' => '[System]',
        //     'message_type' => 'event'
        // ];

        $chatToBroadcast = [
            'code' => $chatMessage->code,
            'message' => $chatMessage->message,
            'sender' => $chatMessage->sender,
            'messageType' => $chatMessage->message_type // 💡 Note: Your event class maps this camelCase property
        ];


        broadcast(new \App\Events\LobbyActivityEvent(new Fluent($chatToBroadcast)))->toOthers();




        return response()->json(['message' => 'Chat message stored successfully'], 201);
    }
}

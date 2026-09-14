<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\LobbyActivityEvent;
use App\Models\Participant;
use Illuminate\Support\Fluent;
use App\Services\ProfanityFilter;

class ChatController extends Controller
{

    public function allChatMessages(String $code)
    {

        return ChatMessage::where('code', $code)
            ->get();
    }

    public function storeChatMessage(Request $request, String $code, ProfanityFilter $profanityFilter)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'participantId' => 'required|exists:participant_tbl,id'
        ]);

        $participant = $request->input('sender');

        $chatMessage = new ChatMessage();
        $chatMessage->code = $code;
        $chatMessage->message = $request->input('message');
        $chatMessage->sender = $request->input('sender');
        $chatMessage->message_type = "chat";
        $chatMessage->participantId = $request->input('participantId');
        $chatMessage->save();

        //     $chatToBroadcast = [
        //     'code' => $code,
        //     'message' => "{$participant} has joined the lobby.",
        //     'sender' => '[System]',
        //     'message_type' => 'event'
        // ];

        $message = $profanityFilter->filter($request->input('message'));


        //   'message' => $chatMessage->message,

        $chatToBroadcast = [
            'code' => $chatMessage->code,
            'message' => $message,
            'sender' => $chatMessage->sender,
            'messageType' => $chatMessage->message_type, // 💡 Note: Your event class maps this camelCase property
            'participantId' => $chatMessage->participantId
        ];


        broadcast(new LobbyActivityEvent(new Fluent($chatToBroadcast)))->toOthers();




        return response()->json(['message' => 'Chat message stored successfully'], 201);
    }
}

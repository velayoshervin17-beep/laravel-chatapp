<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Fluent;
use App\Models\ChatMessage;

class LobbyController extends Controller
{

    public function joinLobby(Request $request, String $code)
    {

        Log::info('Incoming body payload:', $request->all());
        $request->validate([
            'participant' => 'required|string|max:255'
        ]);

        $participant = $request->input('participant');

        $newParticipant = Participant::create([
            'code' => $code,
            'in_game_name' => $participant,
            'lobby_status' => 'joined'
        ]);

        $chatMessage = new ChatMessage();
        $chatMessage->code = $code;
        $chatMessage->message = "{$participant} has joined the lobby.";
        $chatMessage->sender = '[System]';
        $chatMessage->message_type = "event";
        $chatMessage->save();

        $chatToBroadcast = [
            'code' => $chatMessage->code,
            'message' => $chatMessage->message,
            'sender' => $chatMessage->sender,
            'messageType' => $chatMessage->message_type
        ];


        event(new \App\Events\LobbyActivityEvent(new Fluent($chatToBroadcast)));

        return response()->json([
            'success' => 'true',
            'participant' => $newParticipant
        ], 201);
    }

    public function leaveLobby(Request $request, String $code)
    {
        $participant = $request->input('participant');
        $participantId = $request->input('id');

        $player = Participant::find($participantId);

        if (!$player)
            return;

        $player->update([
            'lobby_status' => 'left',
        ]);

        $chatMessage = new ChatMessage();
        $chatMessage->code = $code;
        $chatMessage->message = "{$participant} has left the lobby.";
        $chatMessage->sender = '[System]';
        $chatMessage->message_type = "event";
        $chatMessage->save();

        $chatToBroadcast = [
            'code' => $chatMessage->code,
            'message' => $chatMessage->message,
            'sender' => $chatMessage->sender,
            'messageType' => $chatMessage->message_type
        ];

        event(new \App\Events\LobbyActivityEvent(new Fluent($chatToBroadcast)));

        return response()->json([
            'success message' => 'player has left',
        ], 201);
    }
}

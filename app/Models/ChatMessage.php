<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $table = 'chat_message_tbl';

    protected $fillable = [
        'message',
        'sender',
        'participantId',
    ];
}

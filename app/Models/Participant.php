<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participant_tbl';

    protected $fillable = [
        'code',
        'in_game_name',
        'lobby_status'
    ];
}

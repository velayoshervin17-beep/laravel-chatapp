<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chat_message_tbl')->insert([
            [
                'code' => 'ABC123',
                'message' => 'Hello, this is the first message!',
                'sender' => 'User1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ABC123', // Note: 'code' is unique, so subsequent rows need different codes
                'message' => 'Hi there! Nice to meet you.',
                'sender' => 'User2',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

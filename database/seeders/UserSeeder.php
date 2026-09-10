<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            ['name' => 'Alice',   'email' => 'alice@example.com'],
            ['name' => 'Bob',     'email' => 'bob@example.com'],
            ['name' => 'Charlie', 'email' => 'charlie@example.com'],
            ['name' => 'David',   'email' => 'david@example.com'],
            ['name' => 'Emma',    'email' => 'emma@example.com'],
            ['name' => 'Frank',   'email' => 'frank@example.com'],
            ['name' => 'Grace',   'email' => 'grace@example.com'],
            ['name' => 'Henry',   'email' => 'henry@example.com'],
            ['name' => 'Irene',   'email' => 'irene@example.com'],
            ['name' => 'Jack',    'email' => 'jack@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $password,
            ]);
        }
    }
}

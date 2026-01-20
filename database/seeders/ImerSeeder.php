<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Imer;
use Illuminate\Database\Seeder;

class imerseeder extends Seeder
{
    public function run(): void
    {
        // Create a few sample users if they don't exist
        $users = User::count() < 3
                    ? collect([
                        User::create([
                            'name' => 'Alice Developer',
                            'email' => 'alice@example.com',
                            'password' => bcrypt('amogus'),
                        ]),
                        User::create([
                            'name' => 'Bob Builder',
                            'email' => 'bob@example.com',
                            'password' => bcrypt('amogus'),
                        ]),
                        User::create([
                            'name' => 'Charlie Coder',
                            'email' => 'charlie@example.com',
                            'password' => bcrypt('amogus'),
                        ]),
                    ])
                    : User::take(3)->get();

        // Sample imers
        $imers = [
            'Scooby, Scooby Doo, where are you? 🚀',
            'Hey, there! I\'m using WhatsApp.',
            'Laravel\'s Eloquent ORM is pure magic ✨',
            'I don\'t know what to post lol',
            'Who else is loving this game? Me neither.',
            'Friday deploys with Laravel? No problem! 😎',
        ];

        // Create imers for random users
        foreach ($imers as $message) {
            $users->random()->imers()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}
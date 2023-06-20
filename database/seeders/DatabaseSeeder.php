<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create();
        \App\Models\User::create([
            'name' => 'user1',
            'password' => 'aaa',
            'phone' => '08027259386',
            'email' => 'user1@gmail.com',
        ]);
        \App\Models\User::create([
            'name' => 'user3',
            'password' => 'aaa',
            'phone' => '08027259386',
            'email' => 'user3@gmail.com',
        ]);
        \App\Models\User::create([
            'name' => 'user2',
            'password' => 'aaa',
            'phone' => '08027259386',
            'email' => 'user2@gmail.com',
        ]);

        \App\Models\Dispatcher::create([
            'name' => 'dispatcher3',
            'password' => 'aaa',
            'phone' => '08027259386',
            'email' => 'dispatcher3@gmail.com',
        ]);
        \App\Models\Dispatcher::create([
            'name' => 'dispacher2',
            'password' => 'aaa',
            'phone' => '08027259386',
            'email' => 'dispacher2@gmail.com',
        ]);
        \App\Models\Dispatcher::create([
            'name' => 'dispatcher1',
            'password' => 'aaa',
            'phone' => '08027259386',
            'email' => 'dispatcher1@gmail.com',
        ]);

        // \App\Models\Dispatcher::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}

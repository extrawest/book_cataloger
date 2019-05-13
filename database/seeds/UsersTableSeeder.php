<?php

use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder
{
    public function run()
    {
        User::create([
            'name' => 'Vitaliy',
            'email' => 'admin@admin.com',
            'password' => Hash::make('pass4now'),
        ]);
    }
}
<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersTableSeeder
 *
 */
class ProductionUsersTableSeeder extends Seeder
{
    /**
     * Run seeding default data
     */
    public function run()
    {
        User::create(
            [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('pass4now!'),
            'is_author' =>  false
            ]
        );
    }
}
<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersTableSeeder
 *
 */
class PublisherTableSeeder extends Seeder
{
    /**
     * Run seeding default data
     */
    public function run()
    {
        factory(App\Publisher::class, 50)->create();
    }
}
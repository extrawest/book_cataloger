<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
         $this->call(UsersTableSeeder::class);
         $this->call(PublisherTableSeeder::class);
         $this->call(BookTableSeeder::class);
        Model::reguard();
    }
}

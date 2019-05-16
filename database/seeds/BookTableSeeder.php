<?php

use Illuminate\Database\Seeder;

/**
 * Class BookTableSeeder
 */
class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Book::class, 50)->create();

    }
}

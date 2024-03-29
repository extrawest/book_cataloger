<?php

namespace Tests\Feature;

use App\Book;
use App\Publisher;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class BookTest
 *
 * @package Tests\Feature
 */
class BookTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Book creation
     *
     * @return mixed
     */

    public function createBook()
    {
        $user = User::create(
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => '123456',
                'password_confirmation' => '123456'
            ]
        );
        $publisher = Publisher::create(
            [
                  'title' => $this->faker->title,
                  'url'   => $this->faker->url
            ]
        );
        $book = Book::create(
            [
                'title' => $this->faker->title,
                'publisher_id' => $publisher->id,
                'user_id' => $user->id,
                'isbn' => $this->faker->numberBetween(1, 9999999),
                'count_of_pages' => $this->faker->numberBetween(1, 500)
            ]
        );
        return $book;
    }

    /**
     * Testing the possibility of  getting all books
     *
     * @test
     *
     */
    public function allBook()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $response = $this->json('POST', '/api/books', []);
        $response->assertStatus(200);
    }

    /**
     * Testing the creation of a book
     *
     * @test
     *
     */

    public function addBook()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $book = $this->createBook();
        $attributes = [
            'title' => $this->faker->title,
            'publisher' => $book->publisher_id,
            'author' => $book->user_id,
            'isbn' => $this->faker->numberBetween(1, 9999999),
            'count_of_pages' => $this->faker->numberBetween(1, 500)
        ];
        $structure = [
            'title',
            'isbn',
            'count_of_pages',
            'user_id',
            'publisher_id',
            'updated_at',
            'created_at',
            'id',
        ];
        $response = $this->json("POST", '/api/books/create', $attributes);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

    /**
     * Book editing testing
     *
     * @test
     *
     */

    public function updateBook()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $book = $this->createBook();
        $book_id = $book->id;
        $attributes = [
            'title' => $this->faker->title,
            'publisher' => $book->publisher_id,
            'author' => $book->user_id,
            'isbn' => $this->faker->numberBetween(1, 9999999),
            'count_of_pages' => $this->faker->numberBetween(1, 500)
        ];
        $structure = [
          'id',
          'title',
          'publisher_id',
          'user_id',
          'isbn',
          'count_of_pages',
          'created_at',
          'updated_at'
        ];
        $response = $this->json('POST','/api/books/' . $book_id . '/edit',  $attributes);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

    /**
     * Book removal testing
     *
     * @test
     *
     */

    public function deleteBook()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $book = $this->createBook();
        $structure = [
            'message'
        ];
        $response = $this->json('POST','/api/books/' . $book->id . '/delete', []);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }
}

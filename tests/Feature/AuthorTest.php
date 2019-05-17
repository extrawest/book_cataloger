<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class AuthorTest
 *
 * @package Tests\Feature
 */
class AuthorTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Author creation
     *
     * @return mixed
     */
    public function createUser()
    {
        $user = User::create(
            [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => '123456',
                'password_confirmation' => '123456'
            ]
        );
        return $user;
    }

    /**
     * Testing the possibility of  getting all authors
     *
     * @test
     *
     */
    public function getAllAuthors()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $response = $this->post('/api/authors');
        $response->assertStatus(200);

    }

    /**
     * Testing author creation
     *
     * @test
     *
     */
    public function createNewAuthor()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );
        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $structure = [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ];
        $response = $this->json("POST", '/api/authors/create', $attributes);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

    /**
     * Testing author editing
     *
     * @test
     *
     */
    public function editAuthor()
    {
            Passport::actingAs(
                factory(User::class)->create(),
                ['create-servers']
            );
        $user = $this->createUser();
        $user_id = $user->id;

        $attributes = [
            'name' => $this->faker->name,
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $structure = [
            'id',
            'name',
            'email',
            'is_author',
            'created_at',
            'updated_at',
        ];
        $response = $this->json('POST','/api/authors/' . $user_id . '/edit',  $attributes);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

    /**
     * Testing author removal
     *
     * @test
     *
     */

    public function deleteAuthor()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $user = $this->createUser();
        $user_id = $user->id;
        $structure = [
            'message'
        ];
        $response = $this->json('POST','/api/authors/' . $user_id . '/delete', []);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }
}

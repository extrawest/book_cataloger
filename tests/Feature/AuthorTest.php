<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use WithFaker, RefreshDatabase;


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
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function getAllAuthors()
    {

        $response = $this->post('/api/authors');
        $response->assertStatus(200);

    }
    /** @test */
    public function createNewAuthor()
    {

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

    /** @test */
    public function editAuthor()
    {
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

    /** @test */
    public function deleteAuthor(){
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

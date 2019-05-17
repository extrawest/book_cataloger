<?php

namespace Tests\Feature;

use App\Publisher;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class PublisherTest
 *
 * @package Tests\Feature
 */
class PublisherTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Creating publishing
     *
     * @return mixed
     */
    public function createPublisher()
    {
        $publisher = Publisher::create(
            [
                'title' => $this->faker->title,
                'url'   => $this->faker->url
            ]
        );
        return $publisher;
    }

    /**
     * Testing the possibility of obtaining all publishers
     *
     * @test
     *
     */
    public function allPublishers()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $response = $this->json('POST', '/api/publishers', []);
        $response->assertStatus(200);
    }

    /**
     * Testing the possibility of adding distancing
     *
     * @test
     *
     */

    public function addPublisher()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $attributes = [
            'title' => $this->faker->title,
            'url'   => $this->faker->url
        ];
        $structure = [
          'title',
          'url',
          'updated_at',
          'created_at',
          'id',
        ];
        $response = $this->json("POST", '/api/publishers/create', $attributes);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

    /**
     * Editing Testing
     *
     * @test
     *
     */

    public function updatePublisher()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $publisher = $this->createPublisher();
        $attributes = [
            'title' => $this->faker->title,
            'url'   => $this->faker->url
        ];
        $structure = [
            'title',
            'url',
            'updated_at',
            'created_at',
            'id',
        ];
        $response = $this->json("POST", '/api/publishers/' . $publisher->id . '/edit', $attributes);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

    /**
     * Removal testing
     *
     * @test
     *
     */
    public function deletePublisher()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );

        $publisher = $this->createPublisher();
        $structure = [
            'message'
        ];
        $response = $this->json('POST','/api/publishers/' . $publisher->id . '/delete', []);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

}

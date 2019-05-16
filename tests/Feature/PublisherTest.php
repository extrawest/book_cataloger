<?php

namespace Tests\Feature;

use App\Publisher;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublisherTest extends TestCase
{
    use WithFaker, RefreshDatabase;

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

    /** @test */
    public function allPublishers()
    {
        $response = $this->json('POST', '/api/publishers', []);
        $response->assertStatus(200);
    }

    /** @test */

    public function addPublisher()
    {
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

    /** @test */

    public function updatePublisher()
    {
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

    /** @test */
    public function deletePublisher()
    {
        $publisher = $this->createPublisher();
        $structure = [
            'message'
        ];
        $response = $this->json('POST','/api/publishers/' . $publisher->id . '/delete', []);

        $response->assertStatus(200);
        $response->assertJsonStructure($structure);
    }

}

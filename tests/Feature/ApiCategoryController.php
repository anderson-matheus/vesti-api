<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;

class ApiCategoryController extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        Artisan::call('passport:install', ['--force' => true]);
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $responsetoken = $this->json(
            'POST',
            route('api.authorization.login'),
            $data,
            ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        );
        $token = json_decode($responsetoken->getContent())->token;

        $faker = Factory::create();
        $data = [
            'name' => $faker->name,
        ];

        $response = $this->json(
            'POST',
            route('api.categories.store'),
            $data,
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ]
        );
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApiUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        Artisan::call('passport:install', ['--force' => true]);
        $faker = Factory::create();
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => 'password123',
        ];

        $response = $this->json(
            'POST',
            route('api.users.store'),
            $data,
            ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        );
        $response->assertStatus(200);
    }
}

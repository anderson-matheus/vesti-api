<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;

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
            'password' => $faker->password,
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

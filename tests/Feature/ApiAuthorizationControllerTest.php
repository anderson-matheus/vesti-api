<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class ApiAuthorizationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        Artisan::call('passport:install', ['--force' => true]);
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->json(
            'POST',
            route('api.authorization.login'),
            $data,
            ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        );
        $response->assertStatus(200);
    }

    public function test_logout()
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

        $response = $this->json(
            'POST',
            route('api.authorization.logout'),
            [],
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ]
        );
        $response->assertStatus(200);
    }
}

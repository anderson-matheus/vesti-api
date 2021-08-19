<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApiProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        Artisan::call('passport:install', ['--force' => true]);
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        $responsetoken = $this->json(
            'POST',
            route('api.authorization.login'),
            $data,
            ['Accept' => 'application/json', 'Content-Type' => 'application/json']
        );
        $token = json_decode($responsetoken->getContent())->token;

        $fileName = 'image-test.jpeg';
        $path = "tests/assets/{$fileName}";
        $file = new UploadedFile($path, $fileName, 'image/jpeg', null, true);

        $category = Category::factory()->create();
        $faker = Factory::create();
        $data = [
            'name' => $faker->name,
            'category_id' => $category->id,
            'price' => $faker->randomNumber(2),
            'description' => $faker->text(200),
            'size' => $faker->randomNumber(2),
            'quantity' => $faker->randomNUmber(2),
            'images' => [
                $file,
            ],
        ];

        $response = $this->json(
            'POST',
            route('api.products.store'),
            $data,
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$token}",
            ]
        );
        $response->assertStatus(200);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Storage::disk('public')->deleteDirectory('products');
    }
}

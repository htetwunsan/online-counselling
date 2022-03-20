<?php

namespace Tests\Feature\Auth;

use App\Models\Speciality;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\PreferLanguageSeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SpecialitySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_clients_can_register()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class, ServiceSeeder::class, PreferLanguageSeeder::class]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'questions' => [1, 2, 3],
            'services' => [1, 2],
            'languages' => [1, 2, 3]
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_clients_can_register_through_api()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class, ServiceSeeder::class, PreferLanguageSeeder::class]);

        $response = $this->postJson(route('api.clients.register'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'questions' => [1, 2, 3],
            'services' => [1, 2],
            'languages' => [1, 2, 3]
        ]);

        $response->assertCreated();
    }

    public function test_admin_can_add_counsellor()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class, ServiceSeeder::class, PreferLanguageSeeder::class]);

        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        Storage::fake('images');

        $image = UploadedFile::fake()->image('profile.jpg');

        $response = $this->actingAs($admin)->post(route('admin.counsellors.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'description' => 'Test user with image.',
            'image' => $image,
            'specialities' => [1, 2, 3],
            'services' => [1, 2],
            'languages' => [1, 2, 3]
        ]);

        Storage::disk('images')->assertExists('images/' . $image->hashName());
        $response->assertSessionHas('success', 'Successfully created.');
    }

    public function test_new_counsellors_can_register_through_api()
    {
        $this->seed([SpecialitySeeder::class, QuestionSeeder::class, ServiceSeeder::class, PreferLanguageSeeder::class]);

        Storage::fake('images');

        $image = UploadedFile::fake()->image('profile.jpg');

        $response = $this->postJson(route('api.counsellors.register'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'description' => 'Test user with image.',
            'image' => $image,
            'specialities' => [1, 2, 3],
            'services' => [1, 2],
            'languages' => [1, 2, 3]
        ]);

        Storage::disk('images')->assertExists('images/' . $image->hashName());
        $response->assertCreated();
    }
}

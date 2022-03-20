<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_clients_can_authenticate_through_api()
    {
        $client = User::factory()->create(['role' => 'client']);

        $response = $this->postJson(route('api.login'), [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => 'iPhone7'
        ]);

        $response->assertOk();
    }

    public function test_counsellors_can_authenticate_through_api()
    {
        $client = User::factory()->create(['role' => 'counsellor']);

        $response = $this->postJson(route('api.login'), [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => 'iPhone7'
        ]);

        $response->assertOk();
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}

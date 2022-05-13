<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanRegister(): void
    {
        $response = $this->post('api/auth/register', [
            'name' => 'test name',
            'email' => 'test@test.com',
            'password' => 'secret-pass',
            'password_confirmation' => 'secret-pass',
        ]);

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'access_token',
            ]
        ]);
    }

    public function testUserCanLogin(): void
    {
        $user = User::factory()->create();

        $response = $this->post('api/auth/tokens', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'access_token',
            ]
        ]);
    }

    public function testLoginWithWrongPasswordError(): void
    {
        $user = User::factory()->create();

        $response = $this->post('api/auth/tokens', [
            'email' => $user->email,
            'password' => 'wrong-pass',
        ]);

        $response->assertUnprocessable();
    }
}

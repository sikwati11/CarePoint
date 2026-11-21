<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/')->assertRedirect(route('login'));
        $this->get(route('doctors.index'))->assertRedirect(route('login'));
    }

    public function test_a_user_can_register_login_and_logout(): void
    {
        $this->post(route('register'), [
            'name' => 'Clinic Admin',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('doctors.index'));

        $this->assertAuthenticated();

        $this->post(route('logout'))->assertRedirect(route('login'));
        $this->assertGuest();

        $this->post(route('login'), [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ])->assertRedirect(route('doctors.index'));

        $this->assertAuthenticated();
    }

    public function test_five_failed_attempts_lock_the_login(): void
    {
        User::factory()->create([
            'email' => 'locked@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('login'), [
                'email' => 'locked@example.com',
                'password' => 'wrong-password',
            ]);
        }

        $this->assertTrue(RateLimiter::tooManyAttempts(
            'locked@example.com|127.0.0.1',
            5
        ));

        $this->post(route('login'), [
            'email' => 'locked@example.com',
            'password' => 'correct-password',
        ])->assertSessionHasErrors('email');
    }
}

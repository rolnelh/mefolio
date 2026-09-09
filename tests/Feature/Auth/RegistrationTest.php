<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_redirects_to_onboarding_on_first_visit(): void
    {
        $response = $this->get('/register');

        $response->assertRedirect(route('onboarding'));
    }

    public function test_registration_screen_can_be_rendered_once_onboarded(): void
    {
        $response = $this->withCookie('mefolio_onboarded', '1')->get('/register');

        $response->assertStatus(200);
    }

    public function test_onboarding_screen_can_be_rendered_and_sets_cookie(): void
    {
        $response = $this->get('/bienvenue');

        $response->assertStatus(200);
        $response->assertCookie('mefolio_onboarded');
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => 'creatif',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}

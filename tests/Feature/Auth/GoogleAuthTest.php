<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoogleAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_redirect_falls_back_gracefully_when_not_configured(): void
    {
        config(['services.google.client_id' => null]);

        $response = $this->get(route('google.redirect'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('google_error');
    }

    public function test_role_form_redirects_to_register_without_pending_session(): void
    {
        $response = $this->get(route('google.role'));

        $response->assertRedirect(route('register'));
    }

    public function test_completing_google_signup_creates_user_with_chosen_role(): void
    {
        $response = $this->withSession([
            'google_pending_registration' => [
                'google_id' => '1234567890',
                'name' => 'Awa Diop',
                'email' => 'awa.diop@example.com',
            ],
        ])->post(route('google.role.store'), ['role' => 'client']);

        $response->assertRedirect(route('projects.index'));
        $this->assertAuthenticated();

        $user = User::where('email', 'awa.diop@example.com')->first();
        $this->assertNotNull($user);
        $this->assertSame('client', $user->role);
        $this->assertSame('1234567890', $user->google_id);
        $this->assertNotNull($user->email_verified_at);
        $this->assertNotNull($user->password);
    }

    public function test_completing_google_signup_as_creatif_redirects_to_dashboard(): void
    {
        $response = $this->withSession([
            'google_pending_registration' => [
                'google_id' => '999',
                'name' => 'Kofi Mensah',
                'email' => 'kofi@example.com',
            ],
        ])->post(route('google.role.store'), ['role' => 'creatif']);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    public function test_role_store_rejects_invalid_role(): void
    {
        $response = $this->withSession([
            'google_pending_registration' => [
                'google_id' => '111',
                'name' => 'Test User',
                'email' => 'test.user@example.com',
            ],
        ])->post(route('google.role.store'), ['role' => 'admin']);

        $response->assertSessionHasErrors('role');
        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'test.user@example.com']);
    }

    public function test_role_store_without_pending_session_redirects_to_register(): void
    {
        $response = $this->post(route('google.role.store'), ['role' => 'creatif']);

        $response->assertRedirect(route('register'));
        $this->assertGuest();
    }
}

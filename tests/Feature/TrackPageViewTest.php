<?php

namespace Tests\Feature;

use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackPageViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_normal_page_visit_is_recorded(): void
    {
        $this->get('/')->assertOk();

        $this->assertDatabaseHas('page_views', [
            'path' => '/',
            'referrer_host' => null,
        ]);
    }

    public function test_admin_pages_are_not_tracked(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->actingAs($admin)->get('/admin')->assertOk();

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_ajax_requests_are_not_tracked(): void
    {
        $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])->get('/');

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_known_bot_user_agents_are_not_tracked(): void
    {
        $this->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1)'])->get('/');

        $this->assertDatabaseCount('page_views', 0);
    }

    public function test_external_referrer_host_is_recorded(): void
    {
        $this->withHeaders(['Referer' => 'https://www.google.com/search?q=mefolio'])->get('/projects');

        $this->assertDatabaseHas('page_views', [
            'path' => '/projects',
            'referrer_host' => 'google.com',
        ]);
    }

    public function test_internal_navigation_is_not_treated_as_an_external_referrer(): void
    {
        $this->withHeaders(['Referer' => url('/')])->get('/projects');

        $this->assertDatabaseHas('page_views', [
            'path' => '/projects',
            'referrer_host' => null,
        ]);
    }
}

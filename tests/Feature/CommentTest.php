<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Creatif;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    private function project(): Project
    {
        $owner = User::factory()->create(['role' => User::ROLE_CREATIF]);
        $creatif = Creatif::create(['user_id' => $owner->id, 'slug' => 'owner-' . $owner->id]);

        return Project::create([
            'user_id' => $owner->id,
            'creatif_id' => $creatif->id,
            'title' => 'Un projet',
            'slug' => 'un-projet-' . $owner->id,
        ]);
    }

    public function test_ajax_store_creates_a_comment_and_returns_the_updated_list(): void
    {
        $project = $this->project();
        $commenter = User::factory()->create();

        $response = $this->actingAs($commenter)
            ->withHeaders(['Accept' => 'application/json'])
            ->postJson(route('comments.store', $project), ['body' => 'Très beau travail !']);

        $response->assertOk()->assertJson(['success' => true, 'count' => 1]);
        $this->assertStringContainsString('Très beau travail !', $response->json('html'));
        $this->assertDatabaseHas('comments', ['project_id' => $project->id, 'body' => 'Très beau travail !']);

        // Un commentaire racine rapporte des points au créatif propriétaire du projet.
        $this->assertSame(3, $project->creatif->fresh()->builder_score);
    }

    public function test_non_ajax_store_still_falls_back_to_a_classic_redirect(): void
    {
        $project = $this->project();
        $commenter = User::factory()->create();

        $response = $this->actingAs($commenter)
            ->post(route('comments.store', $project), ['body' => 'Sans JavaScript']);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('comments', ['project_id' => $project->id, 'body' => 'Sans JavaScript']);
    }

    public function test_author_can_update_their_own_comment_within_the_time_window(): void
    {
        $project = $this->project();
        $author = User::factory()->create();
        $comment = Comment::create(['project_id' => $project->id, 'user_id' => $author->id, 'body' => 'Original']);

        $response = $this->actingAs($author)
            ->patchJson(route('comments.update', [$project, $comment]), ['body' => 'Corrigé']);

        $response->assertOk()->assertJson(['success' => true]);
        $this->assertDatabaseHas('comments', ['id' => $comment->id, 'body' => 'Corrigé']);
    }

    public function test_author_cannot_update_after_the_time_window_expires(): void
    {
        $project = $this->project();
        $author = User::factory()->create();
        $comment = Comment::create(['project_id' => $project->id, 'user_id' => $author->id, 'body' => 'Original']);

        Carbon::setTestNow(now()->addMinutes(6));

        $response = $this->actingAs($author)
            ->patchJson(route('comments.update', [$project, $comment]), ['body' => 'Trop tard']);

        $response->assertStatus(403)->assertJson(['success' => false]);
        $this->assertDatabaseHas('comments', ['id' => $comment->id, 'body' => 'Original']);

        Carbon::setTestNow();
    }

    public function test_a_user_cannot_update_someone_elses_comment(): void
    {
        $project = $this->project();
        $author = User::factory()->create();
        $other = User::factory()->create();
        $comment = Comment::create(['project_id' => $project->id, 'user_id' => $author->id, 'body' => 'Original']);

        $this->actingAs($other)
            ->patchJson(route('comments.update', [$project, $comment]), ['body' => 'Piraté'])
            ->assertStatus(403);

        $this->assertDatabaseHas('comments', ['id' => $comment->id, 'body' => 'Original']);
    }

    public function test_author_can_delete_their_own_comment_and_its_points_are_reversed(): void
    {
        $project = $this->project();
        $author = User::factory()->create();

        $this->actingAs($author)
            ->withHeaders(['Accept' => 'application/json'])
            ->postJson(route('comments.store', $project), ['body' => 'À supprimer']);

        $comment = Comment::where('project_id', $project->id)->first();
        $this->assertSame(3, $project->creatif->fresh()->builder_score);

        $response = $this->actingAs($author)
            ->deleteJson(route('comments.destroy', [$project, $comment]));

        $response->assertOk()->assertJson(['success' => true, 'count' => 0]);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
        $this->assertSame(0, $project->creatif->fresh()->builder_score);
    }

    public function test_author_cannot_delete_after_the_time_window_expires(): void
    {
        $project = $this->project();
        $author = User::factory()->create();
        $comment = Comment::create(['project_id' => $project->id, 'user_id' => $author->id, 'body' => 'Original']);

        Carbon::setTestNow(now()->addMinutes(6));

        $this->actingAs($author)
            ->deleteJson(route('comments.destroy', [$project, $comment]))
            ->assertStatus(403);

        $this->assertDatabaseHas('comments', ['id' => $comment->id]);

        Carbon::setTestNow();
    }
}

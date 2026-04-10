<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_task(): void
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Test task',
        ]);

        $response->assertUnauthorized(); // 401
    }

    public function test_authenticated_user_can_create_task(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/tasks', [
            'title' => 'Test task',
        ]);

        $response
            ->assertCreated() // 201
            ->assertJson([
                'title' => 'Test task',
                'status' => 'pending',
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test task',
            'status' => 'pending',
            'user_id' => $user->id,
        ]);
    }

    public function test_title_is_required(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/tasks', [
            'title' => '',
        ]);

        $response
            ->assertUnprocessable() // 422
            ->assertJsonValidationErrors(['title']);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function test_get_all_tasks_for_user():void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/task', [
            'title' => 'Test Task',
        ]);

        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/api/task');

        $response->assertSuccessful();
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'title' => 'Test Task',
        ]);

    }

    public function test_complete_task():void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/task', [
            'title' => 'Test Task',
        ]);

        $response->assertSuccessful();

        
        $response = $this->actingAs($user)->put('/api/task/1');
        
        $response->assertSuccessful();
        
        $response = $this->actingAs($user)->get('/api/task/1');
        $response->assertSuccessful();

        $this->assertSame(1,$response->json('task')['completed']);

    }
}
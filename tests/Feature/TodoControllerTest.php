<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_view_todo()
    {
        // Call the Todo factory to create 10 todos
        Todo::factory(10)->create();

        // Hit the HomeController@index and capture the response
        $response = $this->get('/');

        // Then run through the assertions.
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->has('todos', 10, fn (Assert $todo) => $todo
                ->has('id')
                ->has('task')
                ->has('is_done')
                ->etc()
            )
        );
    }

    public function test_can_complete_todo()
    {
        $todo = Todo::factory()->create([
            'is_done' => false,
        ]);

        $response = $this->put(route('todos.update', $todo), [
            'is_done' => true,
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'is_done' => true,
        ]);
    }

    public function test_can_delete_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}

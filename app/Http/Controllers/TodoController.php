<?php

namespace App\Http\Controllers;

use App\Enums\TodoPriority;
use App\Http\Requests\TodoStoreRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoStoreRequest $request)
    {
        $priority = $request->input('priority');

        Todo::create([
            'task' => $request->input('task'),
            'priority' => $priority != null ? $priority : TodoPriority::Low
        ]);

        return redirect()->to('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, Todo $todo)
    {
        $todo->update([
            'is_done' => $request->boolean('is_done'),
        ]);

        return redirect()->to('/');
    }

    public function updatePriority(Request $request, Todo $todo)
    {
        $todo->update([
            'priority' => $request->input('priority'),
        ]);

        return redirect()->to('/');
    }

    public function updateTask(TodoStoreRequest $request, Todo $todo)
    {
        $todo->update([
            'task' => $request->input('task')
        ]);

        return redirect()->to('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->to('/');
    }
}

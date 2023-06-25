<?php

namespace App\Http\Controllers;

use App\Enums\TodoPriority;
use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $task = $request->query('task');
        $priority = $request->query('priority');
        $query = Todo::query();

        if ($task) {
            $query->where('task', 'like', "%{$task}%");
        }

        if ($priority != null) {
            $query->where('priority','=',$priority);
        }

        $query->orderBy('created_at', 'desc');

        $todos = $query->paginate(10);

        return Inertia::render('Home', [
            'todos' => $todos->items(),
            'todoPagination' => $todos->links()->elements,
            'todoPriorities' => TodoPriority::asSelectArray(),
        ]);
    }
}

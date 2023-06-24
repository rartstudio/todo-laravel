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
        $search = $request->query('task');
        $query = Todo::query();

        if ($search) {
            $query->where('task', 'like', "%{$search}%");
        }

        $query->orderBy('created_at', 'desc');

        $todos = $query->paginate(6);

        return Inertia::render('Home', [
            'todos' => $todos->items(),
            'todoPagination' => $todos->links()->elements,
            'todoPriorities' => TodoPriority::asSelectArray(),
        ]);
    }
}

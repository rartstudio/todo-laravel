<?php

namespace App\Http\Controllers;

use App\Enums\TodoPriority;
use App\Models\Todo;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $todos = Todo::paginate(6);

        return Inertia::render('Home', [
            'todos' => $todos->items(),
            'todoPagination' => $todos->links()->elements,
            'todoPriorities' => TodoPriority::asSelectArray(),
        ]);
    }
}

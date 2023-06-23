<?php

namespace App\Http\Controllers;

use App\Enums\TodoPriority;
use App\Models\Todo;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'todos' => Todo::latest()->get(),
            'todoPriorities' => TodoPriority::asSelectArray(),
        ]);
    }
}

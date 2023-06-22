<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'todos' => Todo::latest()->get(),
        ]);
    }
}

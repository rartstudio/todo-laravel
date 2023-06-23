<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::apiResource('todos', TodoController::class)->except(['index', 'show', 'create', 'edit', 'update']);
Route::put('/todos/{todo}/priority', [TodoController::class, 'updatePriority'])->name('todos.update-priority');
Route::put('/todos/{todo}/task', [TodoController::class, 'updateTask'])->name('todos.update-task');
Route::put('/todos/{todo}/status', [TodoController::class, 'updateStatus'])->name('todos.update-status');

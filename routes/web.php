<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\PreventBackMiddleware; // Add this line

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', 'App\Http\Controllers\UserController@registerForm');
Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::get('/set-password/{code}', 'App\Http\Controllers\UserController@setPasswordForm')->name('set-password');
Route::post('/set-password', 'App\Http\Controllers\UserController@setPassword');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.check'])->group(function () {
    Route::get('/agenda/{month?}', [AgendaController::class, 'showMonthlyAgenda'])
        ->name('agenda')
        ->middleware([PreventBackMiddleware::class]); // Apply middleware to 'agenda' route
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('/task-management', [TaskController::class, 'taskManagement'])->name('task_management');
});
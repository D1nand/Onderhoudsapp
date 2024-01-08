<?php

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

Route::get('/', function () {
    return view('welcome');
    Route::get('/register', 'App\Http\Controllers\UserController@registerForm');
    Route::post('/register', 'App\Http\Controllers\UserController@register');
    Route::get('/set-password/{code}', 'App\Http\Controllers\UserController@setPasswordForm');
    Route::post('/set-password', 'App\Http\Controllers\UserController@setPassword');
});

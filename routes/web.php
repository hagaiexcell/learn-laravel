<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/halo',[HaloController::class,'index']);

Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/login','showLogin')->name('show.login');
    Route::get('/register','showRegister')->name('show.register');
    Route::post('/login','login')->name('login');
    Route::post('/register','register')->name('register');
});

Route::middleware('auth')->controller(TodoController::class)->group(function(){
    Route::get('/todo','index')->name('todo');
    Route::get('/todo/{id}','detail')->name('todo.detail');
    Route::post('/todo','store')->name('todo.post');
    Route::put('/todo/{id}','update')->name('todo.update');
    Route::delete('/todo/{id}','destroy')->name('todo.delete');
});

Route::get('/user/{user:username}',[UserController::class,'index'])->name('user');
Route::get('/category/{category:slug}',[CategoryController::class,'index'])->name('category');


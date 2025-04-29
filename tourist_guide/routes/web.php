<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\UserController;

Route::get('/destinations',function() {return view('destinations.index');});
Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
Route::get('/destination/{id}', [DestinationController::class, 'viewDestination'])->name('destinations.show');

Route::get('/login',function () {return view('login');});

Route::get('/', function () {
    return view('home');
})->middleware('auth:sanctum');

Route::view('/register', 'register');
Route::view('/login', 'login');

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth:sanctum');



Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
Route::get('/destinations/{id}', [DestinationController::class, 'viewDestination'])->name('destinations.show');
Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
Route::put('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update');
Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');

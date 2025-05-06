<?php

use App\Http\Controllers\AgencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\UserController;

// Route::get('/destinations',function() {return view('destinations.index');});
// Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
// Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
// Route::get('/destination/{id}', [DestinationController::class, 'viewDestination'])->name('destinations.show');

// Route::post('/login',function () {return view('login');});

Route::get('/', function () {
    return view('home');
})->middleware('auth:sanctum');

// Route::view('/register', 'register');
// Route::view('/login', 'login');

// users
Route::get('/register',function () {return view('register');});
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login',function () {return view('login');});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware(['auth:sanctum','AdminMiddleware']);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware(['auth:sanctum','AdminMiddleware']);
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth:sanctum','AdminMiddleware']);
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware(['auth:sanctum','AdminMiddleware']);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['auth:sanctum','AdminMiddleware']);




Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index')->middleware('auth:sanctum');
Route::get('/user_destinations', [DestinationController::class, 'index'])->name('destinations.my_index')->middleware('auth:sanctum');
Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create')->middleware(['auth:sanctum','AdminMiddleware']);
Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store')->middleware(['auth:sanctum','AdminMiddleware']);
Route::get('/destinations/{id}', [DestinationController::class, 'viewDestination'])->name('destinations.show')->middleware('auth:sanctum');
Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit'])->name('destinations.edit')->middleware(['auth:sanctum','AdminMiddleware']);
Route::put('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update')->middleware(['auth:sanctum','AdminMiddleware']);
Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');





Route::get('/agencies', [AgencyController::class, 'viewAgencies'])->name('agencies.index');
Route::get('/user_agencies', [AgencyController::class, 'index'])->name('agencies.my_index');
Route::get('/agencies/create', [AgencyController::class, 'create'])->name('agencies.create');
Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');
Route::get('/agencies/{id}', [AgencyController::class, 'viewAgency'])->name('agencies.show');
Route::get('/agencies/{id}/edit', [AgencyController::class, 'edit'])->name('agencies.edit');
Route::put('/agencies/{id}', [AgencyController::class, 'update'])->name('agencies.update');
Route::delete('/agencies/{id}', [AgencyController::class, 'destroy'])->name('agencies.destroy');


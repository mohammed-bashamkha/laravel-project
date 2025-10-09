<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Models\Destination;

// Route::get('/destinations',function() {return view('destinations.index');});
// Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
// Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
// Route::get('/destination/{id}', [DestinationController::class, 'viewDestination'])->name('destinations.show');

// Route::post('/login',function () {return view('login');});

// Route::get('/', function () {
//     return view('home');
// })->middleware('auth:sanctum');

// Route::view('/register', 'register');
// Route::view('/login', 'login');

// users
Route::get('/register',function () {return view('register');});
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login',function () {return view('login');});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::middleware(['auth','SuperAdmin'])->group(function (){
// users routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::middleware(['auth','AdminMiddleware'])->group(function() {
// destinations routes
Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
Route::get('/destinations', [DestinationController::class, 'viewDestinations'])->name('destinations.index');
Route::get('/user_destinations', [DestinationController::class, 'index'])->name('destinations.my_index');
Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
Route::put('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update');
Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');


// agencies routes
Route::get('/agencies/create', [AgencyController::class, 'create'])->name('agencies.create');
Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');
Route::get('/user_agencies', [AgencyController::class, 'index'])->name('agencies.my_index');
Route::get('/agencies/{id}/edit', [AgencyController::class, 'edit'])->name('agencies.edit');
Route::put('/agencies/{id}', [AgencyController::class, 'update'])->name('agencies.update');
Route::delete('/agencies/{id}', [AgencyController::class, 'destroy'])->name('agencies.destroy');
});


Route::middleware('auth')->group(function() {
// destinations view routes

Route::get('/destinations/{id}', [DestinationController::class, 'viewDestination'])->name('destinations.show');

// agencies view routes
Route::get('/agencies', [AgencyController::class, 'viewAgencies'])->name('agencies.index');
Route::get('/agencies/{id}', [AgencyController::class, 'viewAgency'])->name('agencies.show');


// favorites routes
Route::get('/favorites', [DestinationController::class, 'viewFavorites'])->name('destinations.favorites');
Route::post('/favorites/remove/{id}', [DestinationController::class, 'removeFromFavorites']);
Route::post('/favorites/add/{id}', [DestinationController::class, 'addToFavorites']);

});

Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // مسارات إدارية أخرى إن وجدت (مستخدمين، وجهات...)
});



Route::get('/', function () {
    $destinations = Destination::with('images')->take(6)->get();
    return view('welcome', compact('destinations'));
})->name('welcome');

Route::post('/comments/{destination}', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');

Route::post('/ratings/{destination}', [RatingController::class, 'store'])->name('ratings.store')->middleware('auth');

Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('/admin/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::delete('/admin/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});






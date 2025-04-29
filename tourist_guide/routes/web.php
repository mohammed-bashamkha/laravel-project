<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;

Route::get('/destinations',function() {return view('index');});
Route::get('/destinations', [DestinationController::class, 'viewDestinations']);
Route::get('/destinations/{id}', [DestinationController::class, 'viewDestination']);

Route::get('/login',function () {return view('login');});

Route::get('/', function () {
    return view('home');
});

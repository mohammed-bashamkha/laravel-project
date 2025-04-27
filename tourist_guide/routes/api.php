<?php

use App\Http\Controllers\DestinationController;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/destination',[DestinationController::class,'store']);

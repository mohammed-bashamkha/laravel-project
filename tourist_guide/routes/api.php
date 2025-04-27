<?php

use App\Http\Controllers\DestinationController;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/destination',[DestinationController::class,'store']);
Route::get('/destination_show_all',[DestinationController::class,'index']);
Route::put('/destination_update/{id}',[DestinationController::class,'update']);
Route::get('/destination_show/{id}',[DestinationController::class,'show']);
Route::delete('/destination_delete/{id}',[DestinationController::class,'destroy']);

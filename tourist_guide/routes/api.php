<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\DestinationController;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// destination
Route::get('/destination_show/{id}',[DestinationController::class,'show']);
Route::get('/destination_show_all',[DestinationController::class,'index']);


Route::post('/destination',[DestinationController::class,'store']);
Route::put('/destination_update/{id}',[DestinationController::class,'update']);
Route::delete('/destination_delete/{id}',[DestinationController::class,'destroy']);

// Agency
Route::get('/agency_show_all',[AgencyController::class,'index']);
Route::get('/agency_show/{id}',[AgencyController::class,'show']);

Route::post('/agency',[AgencyController::class,'store']);
Route::put('/agency_update/{id}',[AgencyController::class,'update']);
Route::delete('/agency_delete/{id}',[AgencyController::class,'destroy']);

Route::delete('/destination_image/{id}',[DestinationImage::class,'DeleteImage']);

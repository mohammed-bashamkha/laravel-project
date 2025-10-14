<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[UserController::class,'register'])->name('register');
Route::post('login',[UserController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('workers',WorkerController::class);
    Route::delete('logout',[UserController::class,'logout'])->name('logout');
});


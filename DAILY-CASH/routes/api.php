<?php

use App\Http\Controllers\CashBoxController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\RevenuesExpensesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[UserController::class,'register'])->name('register');
Route::post('login',[UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('cashbox',CashBoxController::class);
    Route::put('/cashbox-update', [CashboxController::class, 'update'])->name('cashbox-update');
    Route::apiResource('entities', EntityController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('revenues-expenses', RevenuesExpensesController::class);
    Route::post('delete-my-account',[UserController::class,'deleteMyAccount'])->name('delete-my-account');
    Route::post('logout',[UserController::class,'logout'])->name('logout');
});

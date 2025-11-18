<?php

use App\Http\Controllers\CashBoxController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\JourbalEntryController;
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
    // الراوتر الخاص بالخزنة أضافة مبلغ للخزنة/تعديل المبلغ
    Route::apiResource('cashbox',CashBoxController::class);
    Route::put('/cashbox-update', [CashboxController::class, 'update'])->name('cashbox-update');
    // الراوتر الخاص بالعمال/المشاريع
    Route::get('/entity-statment/{entity_id}', [RevenuesExpensesController::class, 'getEntityStatement'])->name('entity-statement');
    Route::get('/entities/search', [EntityController::class, 'entitySearch']);
    Route::apiResource('entities', EntityController::class);
    Route::get('/get-projects', [EntityController::class, 'getProjects'])->name('get-projects');
    Route::get('/get-workers', [EntityController::class, 'getWorkers'])->name('get-workers');
    // الراوتر الخاص بالمستخدمين
    Route::apiResource('users', UserController::class);
     // بحث في الايرادات والمصروفات
    Route::get('/revenues-expenses/search', [RevenuesExpensesController::class, 'RevenuesExpensesSearch']);
    // جلب اخر خمس عمليات ايردات / مصروفات
    Route::get('/revenues-expenses/last5states', [RevenuesExpensesController::class, 'getLast5states'])->name('revenues-expenses.last5states');
    // الراوتر الخاص بالايرادات والمصروفات
    Route::apiResource('revenues-expenses', RevenuesExpensesController::class);
    // الراوتر الخاص بالقيود المحاسبية
    Route::apiResource('journal-entries', JourbalEntryController::class);
    // عرض كل الايرادات
    Route::get('get-incomes', [RevenuesExpensesController::class, 'getIncomes'])->name('get-incomes');
    // عرض كل المصروفات
    Route::get('get-expenses', [RevenuesExpensesController::class, 'getExpenses'])->name('get-expenses');
    // الراوتر الخاص بحذف حسابي
    Route::post('delete-my-account',[UserController::class,'deleteMyAccount'])->name('delete-my-account');
    // الراوتر الخاص بتسجيل الخروج
    Route::post('logout',[UserController::class,'logout'])->name('logout');
});

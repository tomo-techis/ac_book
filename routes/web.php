<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//メインページ
Route::get('/expense', [App\Http\Controllers\ExpenseController::class,'index'])->middleware('auth');

// 支出登録
Route::post('/expense/regist', [App\Http\Controllers\ExpenseController::class,'regist']);

//支出編集ページへ
Route::get('/expense/edit/{id}', [App\Http\Controllers\ExpenseController::class,'find']);
//支出編集情報上書き
Route::post('/expense/edit', [App\Http\Controllers\ExpenseController::class,'edit']);

//支出編集情報削除
Route::post('/expense/delete', [App\Http\Controllers\ExpenseController::class,'delete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

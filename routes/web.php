<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth','prefix'=>'transactions'],function(){
    
    Route::get('create',[TransactionController::class,'create'])->name('transactions.create');
    Route::get('{transaction}/edit',[TransactionController::class,'edit'])->name('transactions.edit');
    Route::get('{id?}',[TransactionController::class,'index'])->name('transactions.index');
    Route::post('',[TransactionController::class,'store'])->name('transactions.store');
    Route::put('{transaction}',[TransactionController::class,'update'])->name('transactions.update');
    Route::delete('{transaction}',[TransactionController::class,'destroy'])->name('transactions.delete');
    
});

Auth::routes();




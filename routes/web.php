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

Route::get('login',function(){
    echo "login page";
})->name('login');

Route::post('logout',function(){
    Auth::logout();    
})->name('logout');


Route::group(['middleware'=>'auth'],function(){
    Route::get('/transactions/{id?}',[TransactionController::class,'index']);
    Route::post('/transactions',[TransactionController::class,'store']);
});

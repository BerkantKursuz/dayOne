<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

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

Route::get('/login',[adminController::class, 'loginPage'])->name('login');

Route::get('/logout', [adminController::class, 'sesExit'])->name('logout');

Route::get('/panel', [adminController::class, 'adminPanel'])->name('panel');

Route::post('/loginCheck', [adminController::class, 'adminLogin'])->name('adminLogin');


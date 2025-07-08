<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts/app');
});


Route::get('/catalog', [BottleController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'create'])->name('login');
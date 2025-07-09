<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CellarController;



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
})->name('home');


Route::get('/catalog', [BottleController::class, 'index'])->name('index');

// route user
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');
Route::get('/profil', [UserController::class, 'show'])->name('user.show');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/edit/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

// route auth
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');


// route cellier
Route::get('/cellar/create', [CellarController::class, 'create'])->name('cellars.create');
Route::post('/cellar', [CellarController::class, 'store'])->name('cellars.store');

Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/cellars', [CellarController::class, 'index'])->name('cellars.index');
Route::get('/cellars/create', [CellarController::class, 'create'])->name('cellars.create');
Route::post('/cellars/create', [CellarController::class, 'store'])->name('cellars.store');
Route::get('/cellars/edit/{cellar}', [CellarController::class, 'edit'])->name('cellars.edit');
Route::post('/cellars/edit/{cellar}', [CellarController::class, 'update'])->name('cellars.update');
Route::delete('/cellars/{cellar}', [CellarController::class, 'destroy'])->name('cellars.destroy');

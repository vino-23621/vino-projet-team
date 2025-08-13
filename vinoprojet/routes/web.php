<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CellarController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\WishlistController;
use Illuminate\Validation\Rules\Can;

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

Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
})->name('404.custom');

Route::get('/403', function () {
    return response()->view('errors.403', [], 403);
})->name('403.custom');

// route user
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');

// route auth
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');


// authentified route
Route::middleware('auth')->group(function () {
    // route auth
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

    // route user
    Route::get('/profil', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit-name/{user}', [UserController::class, 'editName'])->name('user.edit-name');
    Route::put('/user/edit-name/{user}', [UserController::class, 'updateName'])->name('user.update-name');
    Route::get('/user/edit-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/user/edit-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/user/cellar-default/{cellar_id}', [UserController::class, 'setCellarDefault'])->name('user.cellar-default');


    // route cellier
    Route::get('/cellar/create', [CellarController::class, 'create'])->name('cellars.create');
    Route::post('/cellar', [CellarController::class, 'store'])->name('cellars.store');
    Route::get('/cellars', [CellarController::class, 'index'])->name('cellars.index');
    Route::get('/cellars/create', [CellarController::class, 'create'])->name('cellars.create');
    Route::post('/cellars/create', [CellarController::class, 'store'])->name('cellars.store');
    Route::get('/cellars/{cellar}/edit', [CellarController::class, 'edit'])->name('cellars.edit');
    Route::put('/cellars/{cellar}', [CellarController::class, 'update'])->name('cellars.update');
    Route::delete('/cellars/{cellar}', [CellarController::class, 'destroy'])->name('cellars.destroy');

    Route::get('/cellars/{cellar}/show', [CellarController::class, 'show'])->name('cellars.show');
    Route::post('/cellars/add-bottle', [CellarController::class, 'addBottle'])->name('cellars.addBottle');
    Route::delete('/cellars/{cellar}/show/{bottle}', [CellarController::class, 'removeBottle'])->name('cellars.removeBottle');


    // route catalog
    Route::get('/catalog', [BottleController::class, 'index'])->name('catalog.index');
    Route::post('/catalog/add/{bottle}', [CatalogController::class, 'addWineFromCatalog'])->name('catalog.addWineFromCatalog');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');


    // route cellar_bottles
    Route::get('/cellars/{cellar}/bottles/{bottle}/edit', [CellarController::class, 'editBottle'])->name('cellars.editBottle');
    Route::put('/cellars/{cellar}/bottles/{bottle}', [CellarController::class, 'updateQuantity'])->name('cellars.updateQuantity');

    //api search bar
    // Route::get('/catalog-data', [CatalogController::class, 'apiCatalog']);


    // route wishlist
    Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.index');
    Route::post('/wishlist/add-bottle', [WishlistController::class, 'addToWishList'])->name('wishlist.addToWishList');
    Route::delete('wishlist/{bottle}', [WishlistController::class, 'removeBottle'])->name('wishlist.removeBottle');
    Route::get('/wishlist/{bottle}/edit', [WishlistController::class, 'editBottle'])->name('wishlist.editBottle');
    Route::put('/wishlist/{bottle}/update', [WishlistController::class, 'updateQuantity'])->name('wishlist.updateQuantity');
});

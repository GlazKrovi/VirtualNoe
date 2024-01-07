<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/**
 * Home, index
 */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Authentification
 */
Route::group(['middleware' => 'web'], function () {
    Auth::routes();
});

/**
 * Admin Zone
 */
Route::prefix("admin")->group(function () {
    Route::view('/dev', 'dev')->name('view_dev');   
});

/**
 * User Zone
 */
Route::prefix("user")->group(function () {
    Route::get('/inventory', [InventoryController::class, 'show'])->name('view_inventory');   
});
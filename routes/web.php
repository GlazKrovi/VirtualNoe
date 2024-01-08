<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

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
Route::view('/', 'home')->name('view_home');

/**
 * Admin Zone
 */
Route::view('/dev', 'dev')->name('view_dev');   
Route::get('/logs', [LogController::class, 'show'])->name('logs_show');   
Route::get('/destroy', function () { session()->flush(); return redirect()->route('view_home'); })->name('session_destroy');

/**
 * User Zone
 */
Route::prefix("user")->group(function () {
    /* Authentification */
    Route::view('/signin', 'signin')->name('view_signin');	
    Route::view('/signup', 'signup')->name('view_signup');	
    Route::post('/authenticate', [UserController::class, 'connect'])->name('user_authenticate');
    Route::post('/adduser', [UserController::class, 'create'])->name('user_adduser');

    /* His stuff */
    Route::prefix("inventory")->middleware('auth.myuser')->group(function () {
        Route::get('/show', [InventoryController::class, 'show'])->name('inventory_show');  
    }); 

    /* His account */
    Route::prefix('admin')->middleware('auth.myuser')->group(function () { // alway verify if user is connected 
        Route::view('/account', 'account')->name('view_account');
        Route::view('/formpassword','formpassword')->name('view_formpassword');
        Route::post('/changepassword', [UserController::class, 'updatePassword'])->name('user_changepassword');
        Route::get('/deleteuser', [UserController::class, 'delete'])->name('user_deleteuser');
        Route::get('/signout', [UserController::class, 'disconnect'])->name('user_signout');
    });
});


			


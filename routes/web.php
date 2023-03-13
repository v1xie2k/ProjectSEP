<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckLogin;
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
Route::get('/', [SiteController::class,'login']);
Route::get('/login', [SiteController::class,'login']);
Route::post('/dologin', [SiteController::class,'dologin']);
Route::get('/register', [SiteController::class,'register']);
Route::post('/doregister', [SiteController::class,'doregister']);
Route::post('/dologout', [SiteController::class,'dologout']);
Route::get('/dologout', [SiteController::class,'dologout']);

Route::prefix('home')->group(function () {
    Route::get('/', [SiteController::class,'home']);

    Route::prefix('menu')->group(function () {
        Route::get('',[HomePageController::class,'home']);
    });

    Route::prefix('cart')->middleware([CheckLogin::class])->group(function () {
        Route::get('',[CartController::class,'home']);
    });

    Route::prefix('user')->middleware([CheckLogin::class])->group(function () {
        Route::get('profile',[UserController::class,'profile']);
        Route::get('editprofile/{id}',[UserController::class,'editprofile']);
        Route::get('editpassword/{id}',[UserController::class,'editpassword']);
        Route::post('doedit/{id}',[UserController::class,'doedit']);
        Route::post('doedit/password/{id}',[UserController::class,'doeditpassword']);
    });
});

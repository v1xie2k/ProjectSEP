<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SiteController;
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

Route::prefix('home')->group(function () {
    Route::get('/', [SiteController::class,'home']);

    Route::prefix('menu')->group(function () {
        Route::get('',[HomePageController::class,'home']);
    });
});

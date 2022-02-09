<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\SlideController;
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
    return view('homepage');
});
Route::get('homepage', [LoginController::class, 'homepage'])->name('homepage');
Route::post("login", [LoginController::class, 'login'])->name("login");
Route::post("register", [LoginController::class, 'register'])->name("register");
Route::get("logout", [LoginController::class, 'logout'])->name("logout");

// editpage
Route::get('edit/home',[EditController::class,'home'])->name('edit.home');
// slide
Route::post('slide/number',[SlideController::class,'number'])->name('slide.number');
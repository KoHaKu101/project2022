<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutSchoolController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
use App\Models\AboutSchool;

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

Route::get('/', [HomepageController::class, 'homepage']);

Route::get('homepage', [HomepageController::class, 'homepage'])->name('homepage');
//login and Register
Route::post("login", [LoginController::class, 'login'])->name("login");
Route::post("register", [LoginController::class, 'register'])->name("register");
Route::get("logout", [LoginController::class, 'logout'])->name("logout");

// editpage
Route::get('edit/home',[EditController::class,'home'])->name('edit.home');

// slide
Route::post('slide/number',[SlideController::class,'number'])->name('slide.number');
Route::post('slide/upload',[SlideController::class,'upload'])->name('slide.upload');
Route::post('slide/remove',[SlideController::class,'remove'])->name('slide.remove');
//director
Route::post('director/upload',[DirectorController::class,'upload'])->name('director.upload');
Route::post('director/post',[DirectorController::class,'post'])->name('director.post');

//post
Route::post('post/insert')->name('post.insert');
Route::post('post/update')->name('post.update');
Route::post('post/delete')->name('post.delete');

//about
Route::post('about/insert',[AboutSchoolController::class,'insert'])->name('about.insert');
Route::post('about/update',[AboutSchoolController::class,'update'])->name('about.update');
Route::post('about/delete',[AboutSchoolController::class,'delete'])->name('about.delete');
Route::get('about/show',[AboutSchoolController::class,'show'])->name('about.show');
<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutSchoolController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DetailSchoolController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\EmpRankController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\EmpSchoolController;

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
Route::get('homepage/detail/{DETAIL_TYPE}', [HomepageController::class, 'detail'])->name('homepage.detail');
Route::get('homepage/employee', [HomepageController::class, 'employee'])->name('homepage.employee');

Route::post('homepage/showpost', [HomepageController::class, 'showpost'])->name('homepage.showpost');


//login and Register
Route::post("login", [LoginController::class, 'login'])->name("login");
Route::post("register", [LoginController::class, 'register'])->name("register");
Route::get("logout", [LoginController::class, 'logout'])->name("logout");

// editpage
Route::get('edit/home',[EditController::class,'home'])->name('edit.home');
Route::post('edit/fetch/post',[EditController::class,'fetchpost'])->name('edit.fetch.post');
Route::get('edit/settingpage',[EditController::class,'settingpage'])->name('edit.settingpage');
Route::get('edit/school',[EditController::class,'school'])->name('edit.school');
Route::get('edit/emp',[EditController::class,'emp'])->name('edit.emp');

//detail school
Route::post('edit/school/insert',[DetailSchoolController::class,'insert'])->name('edit.school.insert');
Route::post('edit/school/insert_detail',[DetailSchoolController::class,'insert_detail'])->name('edit.school.insert_detail');
Route::post('edit/school/update',[DetailSchoolController::class,'update'])->name('edit.school.update');
Route::post('edit/school/update_detail',[DetailSchoolController::class,'update_detail'])->name('edit.school.update_detail');
Route::post('edit/school/delete',[DetailSchoolController::class,'delete'])->name('edit.school.delete');
Route::post('edit/school/delete_detail',[DetailSchoolController::class,'delete_detail'])->name('edit.school.delete_detail');
Route::get('edit/school/show/{UNID}',[DetailSchoolController::class,'show'])->name('edit.school.show');
Route::get('edit/school/show_edit/{UNID}',[DetailSchoolController::class,'show_edit'])->name('edit.school.show_edit');

//settingpage
Route::post('edit/tag/save',[tagController::class,'save'])->name('edit.tag.save');
Route::post('edit/tag/edit',[tagController::class,'edit'])->name('edit.tag.edit');
Route::get('edit/tag/remove',[tagController::class,'remove'])->name('edit.tag.remove');
Route::post('edit/tag/status',[tagController::class,'status'])->name('edit.tag.status');
Route::post('edit/tag/show',[tagController::class,'show'])->name('edit.tag.show');
Route::post('edit/tag/ajaxshow',[tagController::class,'ajaxshow'])->name('edit.tag.ajaxshow');
// slide
Route::post('slide/number',[SlideController::class,'number'])->name('slide.number');
Route::post('slide/upload',[SlideController::class,'upload'])->name('slide.upload');
Route::post('slide/remove',[SlideController::class,'remove'])->name('slide.remove');
//director
Route::post('director/upload',[DirectorController::class,'upload'])->name('director.upload');
Route::post('director/post',[DirectorController::class,'post'])->name('director.post');

//post
Route::post('post/insert/default',[PostController::class,'insert_default'])->name('post.insert.default');
Route::post('post/insert/pdf',[PostController::class,'insert_pdf'])->name('post.insert.pdf');
Route::post('post/update')->name('post.update');
Route::post('post/delete')->name('post.delete');
Route::post('post/checkform/default',[PostController::class,'checkform_default'])->name('post.checkform.default');
Route::post('post/checkform/pdf',[PostController::class,'checkform_pdf'])->name('post.checkform.pdf');

//about
Route::post('about/insert',[AboutSchoolController::class,'insert'])->name('about.insert');
Route::post('about/update',[AboutSchoolController::class,'update'])->name('about.update');
Route::post('about/delete',[AboutSchoolController::class,'delete'])->name('about.delete');
Route::get('about/show',[AboutSchoolController::class,'show'])->name('about.show');
//contract
Route::post('contract/insert/map',[ContractController::class,'insert_map'])->name('contract.insert.map');
Route::post('contract/insert/data',[ContractController::class,'insert_data'])->name('contract.insert.data');
Route::post('contract/delete/data',[ContractController::class,'delete_data'])->name('contract.delete.data');
//emp rank
Route::post('emprank/insert',[EmpRankController::class,'insert'])->name('emprank.insert');
Route::post('emprank/update',[EmpRankController::class,'update'])->name('emprank.update');
Route::post('emprank/delete',[EmpRankController::class,'delete'])->name('emprank.delete');
//emp
Route::get('empschool/show',[EmpSchoolController::class,'show'])->name('empschool.show');
Route::get('empschool/edit/{UNID}',[EmpSchoolController::class,'edit'])->name('empschool.edit');
Route::post('empschool/insert',[EmpSchoolController::class,'insert'])->name('empschool.insert');
Route::post('empschool/update/{UNID}',[EmpSchoolController::class,'update'])->name('empschool.update');
Route::post('empschool/delete',[EmpSchoolController::class,'delete'])->name('empschool.delete');
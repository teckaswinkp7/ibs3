<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Front\Auth\AuthControllers;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\ProductCRUDController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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
Auth::routes();
//Auth::routes(['verify' => true]);
Route::get('/',[WelcomeController::class, 'index'])->middleware('cors');;
Route::get('send-mail', 'App\Http\Controllers\MailController@sendMail')->name('send.mail');
Route::post('otp-validate', [AuthControllers::class, 'validateOtp'])->name('validateOtp');
Route::post('otp-resend', [AuthControllers::class, 'resendOtp'])->name('resendOtp');
Route::get('registration', [AuthControllers::class, 'registration'])->name('registers');
Route::post('post-registration', [AuthControllers::class, 'postRegistration'])->name('register.post'); 
Route::get('admin/login', [AuthController::class, 'index'])->name('admin_login');
Route::post('admin/post-login', [AuthController::class, 'postLogin'])->name('admin/login.post'); 
Route::get('login', [AuthControllers::class, 'index'])->name('login');
Route::post('post-login', [AuthControllers::class, 'postLogin'])->name('login.post');
Route::post('admin/post-registration', [AuthController::class, 'postRegistration'])->name('admin/register.post'); 
Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('admin-dashboard'); 
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin/logout');
Route::get('dashboard', [AuthControllers::class, 'dashboard'])->name('dashboard'); 
Route::get('profile', [AuthControllers::class, 'profile'])->name('update-profile');
Route::get('logout', [AuthControllers::class, 'logout'])->name('logout.front');
Route::resource('admin/courses', CoursesController::class);
Route::resource('admin/categories', CategoryController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/role', RoleController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/user', UserController::class);
});
Route::post('admin/subcat', 'App\Http\Controllers\CoursesController@subCat')->name('subcat');


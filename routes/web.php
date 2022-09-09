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
use App\Http\Controllers\Front\EducationController;
use App\Http\Controllers\Admin\ScreeningController;
use App\Http\Controllers\Admin\DocumentVerificationController;
use App\Http\Controllers\Admin\StudentcourseController;
use App\Http\Controllers\Admin\BankController;

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
Route::get('admin/screening', 'App\Http\Controllers\Admin\ScreeningController@index')->name('screening.index');
Route::get('admin/enrollment/', 'App\Http\Controllers\Admin\DocumentVerificationController@index')->name('enrollment.index');
Route::get('admin/enrollment/verify/{id}', 'App\Http\Controllers\Admin\DocumentVerificationController@verify')->name('enroll.verify');
Route::post('admin/enrollment/store', [DocumentVerificationController::class, 'store'])->name('enrollment.store');
Route::post('admin/screening/store', [ScreeningController::class, 'store'])->name('screening.store');
Route::get('admin/screening/course/{id}', [ScreeningController::class, 'course'])->name('screening.course');
Route::post('admin/subcat', 'App\Http\Controllers\Admin\CoursesController@subCat')->name('subcat');
Route::get('education-profile', [EducationController::class, 'index']);
Route::get('admin/studentcourse/', [StudentcourseController::class, 'index'])->name('studentcourse.index');
Route::get('admin/studentcourse/courseoffer/{id}', [StudentcourseController::class, 'courseoffer'])->name('student.courseoffer');
Route::get('admin/studentcourse/sendcourseInvoice/{id}', [StudentcourseController::class, 'sendcourseInvoice'])->name('student.sendcourseInvoice');

Route::post('admin/studentcourse/store/', [StudentcourseController::class, 'store'])->name('studentcourse.store');
Route::post('admin/studentcourse/storeInvoice/', [StudentcourseController::class, 'storeInvoice'])->name('studentcourse.storeInvoice');

Route::get('admin/studentcourse/invoice/', [StudentcourseController::class, 'invoice'])->name('studentcourse.invoice');
Route::get('admin/bank/', [BankController::class, 'index'])->name('bank.index');
Route::get('admin/bank/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
Route::post('admin/bank/update/{id}', [BankController::class, 'update'])->name('bank.update');



Route::post('edit-profile', [EducationController::class, 'store']);
Route::post('student-course', [AuthControllers::class, 'studentCoursestore'])->name('student.course');
Route::get('products', 'ProductController@index')->name('products.index');
Route::get('education/create-step-one',[EducationController::class, 'createStepOne'])->name('education.create.step.one');
Route::post('education/create-step-one',[EducationController::class, 'postCreateStepOne'])->name('education.create.step.one.post');
Route::get('education/course-offer',[EducationController::class, 'getCourseOffers'])->name('education.course.offer');

Route::get('education/create-step-two',  [EducationController::class, 'createStepTwo'])->name('education.create.step.two');
Route::post('education/create-step-two', [EducationController::class, 'postCreateStepTwo'])->name('education.create.step.two.post');

Route::get('education/create-step-three', 'EducationController@createStepThree')->name('products.create.step.three');
Route::post('education/create-step-three', 'EducationController@postCreateStepThree')->name('products.create.step.three.post');
Route::post('approve/{id}', [AuthControllers::class, 'approve'])->name('approve');
Route::post('decline/{id}', [AuthControllers::class, 'decline'])->name('decline');

Route::get('education/courseApproved', [AuthControllers::class, 'approve_course'])->name('courseApproved');
Route::get('education/courseDenied', [AuthControllers::class, 'deny_course'])->name('courseDenied');


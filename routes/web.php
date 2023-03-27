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
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\DocumentVerificationController;
use App\Http\Controllers\Admin\StudentcourseController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\PaymentlistController;
use App\Http\Controllers\Admin\Enrolmentcontroller;
use App\Http\Controllers\Admin\Invoicelistcontroller;
use App\Http\Controllers\Admin\Registeredstudentscontroller;
use App\Http\Controllers\Admin\confirmedstudentscontroller;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\Reportingcontroller;
use App\Http\Controllers\Admin\Recieptverificationcontroller;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Front\AssignmentsubmissionController;
use App\Http\Controllers\Front\Sponsorstudentcontroller;
use App\Http\Controllers\Front\StudentAssignmentController;
use App\Http\Controllers\Front\ForgotPasswordController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Front\Invoicecontroller;
use App\Http\Controllers\Front\StudentExamController;
use App\Http\Controllers\Admin\AssignmentGradeController;
use App\Http\Controllers\Admin\Pagescontroller;
use App\Http\Controllers\Admin\Menuitemscontroller;
use App\Http\Controllers\Admin\Unitcontroller;
use App\Http\Controllers\Admin\Additionalfeecontroller;
use App\Http\Controllers\Admin\Unitselectioncontroller;
use App\Http\Controllers\Admin\Semcontroller;
use App\Http\Controllers\Admin\Searchcontroller;
use App\Http\Controllers\Admin\Officercontroller;

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
//Route::get('send-mail', 'App\Http\Controllers\MailController@sendMail')->name('send.mail');
Route::post('otp-validate', [AuthControllers::class, 'validateOtp'])->name('validateOtp');
Route::post('otp-resend', [AuthControllers::class, 'resendOtp'])->name('resendOtp');
Route::get('registration', [AuthControllers::class, 'registration'])->name('registers');
Route::get('userprofile', [AuthControllers::class, 'user_profile'])->name('userprofiles');
Route::post('updateprofile', [AuthControllers::class, 'update_profile'])->name('updateprofile');
Route::get('coursestatus/{id}', [AuthControllers::class, 'studentCourseInsert'])->name('coursestatus');
Route::get('unauthorized', [AuthControllers::class, 'error_page'])->name('unauthorized');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('changeuser', [AuthControllers::class, 'change_user'])->name('changeuser');
Route::get('changepassword', [AuthControllers::class, 'change_pass'])->name('changepassword');
Route::post('updateusername', [AuthControllers::class, 'update_username'])->name('updateusername');
Route::post('updatepasswords', [AuthControllers::class, 'update_passwords'])->name('updatepasswords');


Route::get('useroffer', [EducationController::class, 'user_offer'])->name('useroffer');
Route::get('userofferaccept', [EducationController::class, 'user_offer_accept'])->name('userofferaccept');
Route::post('courseofferpost', [EducationController::class, 'courseofferpost'])->name('courseofferpost');
Route::post('semeseterselect', [EducationController::class, 'semesterselect'])->name('semesterselect');
Route::post('semeseterpost', [EducationController::class, 'semesterpost'])->name('semesterpost');
Route::get('offer-pdf', [EducationController::class, 'offerpdf'])->name('offerpdf');

Route::get('coursedefer', [EducationController::class, 'coursedefer'])->name('coursedefer');
Route::post('coursesdefer', [EducationController::class, 'coursesdefer'])->name('coursesdefer');
Route::get('useroffercongrats', [EducationController::class, 'user_offer_congrats'])->name('useroffercongrats');
Route::get('coursedeferdate', [EducationController::class, 'coursedeferdate'])->name('coursedeferdate');
Route::post('coursedefersdate', [EducationController::class, 'coursedefersdate'])->name('coursedefersdate');
Route::get('search', [Searchcontroller::class, 'index'])->name('search.index');




/** Pro Forma Invoice  */

Route::group(['middleware' => 'auth'], function () {
   

Route::get('proformainvoice', [Invoicecontroller::class, 'index'])->name('proformainvoice');
Route::post('proformainvoicepost', [Invoicecontroller::class, 'store'])->name('proformainvoicepost');
Route::get('proformainvoicepreview', [Invoicecontroller::class, 'preview'])->name('proformainvoicepreview');
Route::get('proformasalesinvoice', [Invoicecontroller::class, 'salesinvoice'])->name('proformasalesinvoice');
Route::get('confirmpayment', [Invoicecontroller::class, 'payment'])->name('confirmpayment');
Route::get('sponsorlist', [Invoicecontroller::class, 'sponsorlist'])->name('sponsorlist');
Route::post('sponsorrequest', [Invoicecontroller::class, 'sponsorrequest'])->name('sponsorrequest');
Route::post('refundpolicypost', [Invoicecontroller::class, 'refund'])->name('refundpolicypost');
Route::get('refundrequest', [Invoicecontroller::class, 'refundrequest'])->name('refundrequest');
Route::post('refundrequestpost', [Invoicecontroller::class, 'refundrequestpost'])->name('refundrequestpost');
Route::post('totalpost', [Invoicecontroller::class, 'total'])->name('totalpost');
Route::get('attachreciept', [Invoicecontroller::class, 'recieptsubmit'])->name('recieptsubmit');
Route::get('submitsuccess', [Invoicecontroller::class, 'success'])->name('submitsuccess');
Route::post('recieptpost', [Invoicecontroller::class, 'reciept'])->name('recieptpost');
Route::get('history', [Invoicecontroller::class, 'history'])->name('history');
Route::get('/invoice',[Invoicecontroller::class, 'viewpdf'])->name('invoice');


Route::get('refund', [Refundcontroller::class, 'index'])->name('refund.index');



Route::get('generate-invoice/{id}', [PDFController::class, 'generateInvoicePDF'])->name('generate.invoice');
});
/**  Reciept Verification Admin  */

Route::get('reciept', [Recieptverificationcontroller::class, 'index'])->name('reciept.index');
Route::get('recieptconfirm', [Recieptverificationcontroller::class, 'confirm'])->name('reciept.confirm');
Route::post('recieptconfirmstore', [Recieptverificationcontroller::class, 'store'])->name('confirm.store');


/**Admin New  */

Route::get('admin/payment', [PaymentlistController::class, 'index'])->name('paymentlist.index');
Route::get('admin/payment/invoice/{id}', [PaymentlistController::class, 'xeroconnection'])->name('paymentlist.xeroconnection');
Route::get('admin/payment/searchdate', [PaymentlistController::class, 'paymentlistdatesearch'])->name('paymentlistdatesearch');
Route::get('admin/payment/searchname', [PaymentlistController::class, 'paymentlistnamesearch'])->name('paymentlistnamesearch');
Route::get('admin/payment/exportpaymentlist', [PaymentlistController::class, 'exportpaymentlist'])->name('exportpaymentlist');
Route::get('admin/enrollment', [EnrolmentController::class, 'index'])->name('manageenrollment.index');
Route::get('admin/enrollment/search', [EnrolmentController::class, 'searchnameenrollment'])->name('searchnameenrollment');
Route::get('admin/enrollment/exportenrolled', [EnrolmentController::class, 'EnrolledUsers'])->name('EnrolledUsers');
Route::get('admin/invoicelistpanel', [Invoicelistcontroller::class, 'index'])->name('invoicelist.index');
Route::get('admin/invoicelistpanel/searchdate', [Invoicelistcontroller::class, 'invoicedatesearch'])->name('invoicedatesearch');
Route::get('admin/invoicelistpanel/search', [Invoicelistcontroller::class, 'invoicesearch'])->name('invoicesearch');
Route::get('admin/invoicelistpanel/export', [Invoicelistcontroller::class, 'invoicelistExport'])->name('invoicelistExport');

Route::post('post-registration', [AuthControllers::class, 'postRegistration'])->name('register.post'); 
Route::post('final-registration', [AuthControllers::class, 'confirm_register'])->name('register.final'); 
Route::get('admin/login', [AuthController::class, 'index'])->name('admin_login');
Route::get('setpassword', [AuthController::class, 'set_password'])->name('setpassword');
Route::post('admin/post-login', [AuthController::class, 'postLogin'])->name('admin/login.post'); 
Route::get('login', [AuthControllers::class, 'index'])->name('login');
Route::post('post-login', [AuthControllers::class, 'postLogin'])->name('login.post');
Route::post('admin/post-registration', [AuthController::class, 'postRegistration'])->name('admin/register.post'); 
Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('admin-dashboard'); 
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin/logout');
Route::get('dashboard', [AuthControllers::class, 'dashboard'])->name('dashboard'); 
Route::get('profile', [AuthControllers::class, 'profile'])->name('update-profile');
Route::get('logout', [AuthControllers::class, 'logout'])->name('logout.front');
Route::get('formcheck/chk', [AuthControllers::class, 'password_form'])->name('formcheck');
Route::resource('admin/courses', CoursesController::class);
Route::resource('admin/categories', CategoryController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/role', RoleController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/user', UserController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/officer', Officercontroller::class);
});

/*  Sponsor Front     */
Route::get('sponsorlogin', [AuthControllers::class, 'sponsorlogin'])->name('sponsorlogin');
Route::get('sponsorprofile', [AuthControllers::class, 'sponsorprofile'])->name('sponsorprofile');
Route::post('sponsorprofilepost', [AuthControllers::class, 'sponsorprofilepost'])->name('sponsorprofilepost');
Route::get('sponsorstudentview', [Sponsorstudentcontroller::class, 'index'])->name('sponsorstudentview');
Route::post('sponsoredstudent', [Sponsorstudentcontroller::class, 'sponsoredstudent'])->name('sponsoredstudent');
Route::get('sponsoredstudents', [Sponsorstudentcontroller::class, 'sponsoredstudentview'])->name('sponsoredstudents');
Route::get('confirmsponsorpayment', [Sponsorstudentcontroller::class, 'confirmsponsorpayment'])->name('confirmsponsorpayment');
Route::post('confirmsponsorajax', [Sponsorstudentcontroller::class, 'ajax'])->name('confirmsponsorajax');
Route::post('confirmpaymentpost', [Sponsorstudentcontroller::class, 'confirmpaymentpost'])->name('confirmpaymentpost');
Route::get('onlinesponsorpayment', [Sponsorstudentcontroller::class, 'onlinesponsor'])->name('onlinesponsorpayment');
Route::post('payrecieptpost', [Sponsorstudentcontroller::class, 'payrecieptpost'])->name('payrecieptpost');
Route::get('sponsorrecieptsubmitsuccess', [Sponsorstudentcontroller::class, 'recieptsuccess'])->name('sponsorrecieptsubmitsuccess');
Route::get('sponsorhistory', [Sponsorstudentcontroller::class, 'history'])->name('sponsorhistory');



Route::get('admin/screening', 'App\Http\Controllers\Admin\ScreeningController@index')->name('screening.index');
Route::get('admin/application/', 'App\Http\Controllers\Admin\DocumentVerificationController@index')->name('application.index');
Route::get('admin/application/verify/{id}', 'App\Http\Controllers\Admin\DocumentVerificationController@verify')->name('application.verify');
Route::post('admin/application/obtain', [DocumentVerificationController::class, 'obtain'])->name('application.obtain');
Route::post('admin/application/send', [DocumentVerificationController::class, 'send'])->name('application.send');
Route::post('admin/application/store', [DocumentVerificationController::class, 'store'])->name('application.store');
Route::get('admin/application/search', 'App\Http\Controllers\Admin\DocumentVerificationController@search')->name('application.search');
Route::get('admin/application/searchname', 'App\Http\Controllers\Admin\DocumentVerificationController@searchname')->name('application.searchname');
Route::get('application_export',[DocumentVerificationController::class, 'userexport'])->name('application.export');
Route::post('admin/screening/store', [ScreeningController::class, 'store'])->name('screening.store');
Route::get('admin/screening/course/{id}', [ScreeningController::class, 'course'])->name('screening.course');
Route::post('admin/subcat', 'App\Http\Controllers\Admin\CoursesController@subCat')->name('subcat');
Route::get('admin/courses/offer_accepted/{id}', [CoursesController::class,'offer_accepted'])->name('reports.offer_accepted');
Route::get('admin/courseselected/offer_accepted/search', [CoursesController::class,'searchofferaccepted'])->name('reports.searchofferaccepted');
Route::get('admin/courseselected/offer_accepted/namesearch',[CoursesController::class,'namesearchofferaccepted'])->name('reports.namesearchofferaccepted');
Route::get('/offeraccepted-users',[CoursesController::class,'offeracceptedExport'])->name('offeraccepted.export');
Route::get('admin/courses/enrolledusers/{id}', [CoursesController::class,'enrolledusers'])->name('reports.enrolledusers');
Route::get('admin/courseselected/enrolledusers/search', [CoursesController::class,'searchenrolledusers'])->name('reports.searchenrolledusers');
Route::get('admin/courseselected/enrolledusers/namesearch', [CoursesController::class,'namesearchenrolledusers'])->name('reports.namesearchenrolledusers');
Route::get('/enrolled-users',[CoursesController::class,'enrolledusersExport'])->name('enrolledusers.export');

Route::get('admin/search', [CoursesController::class, 'searchcoursedate'])->name('courses.searchcoursedate');
Route::get('admin/searchcourse', [CoursesController::class, 'coursesearch'])->name('courses.coursesearch');
Route::get('education-profile', [EducationController::class, 'index']);
Route::post('education-receipt', [EducationController::class, 'upload_invoice'])->name('education.receipt');
Route::post('education-receipt-sponsor', [EducationController::class, 'upload_invoice_sponsor'])->name('education.sponsor.receipt');
Route::get('admin/studentcourse/', [StudentcourseController::class, 'index'])->name('studentcourse.index');
Route::get('admin/studentcourse/courseoffer/{id}', [StudentcourseController::class, 'courseoffer'])->name('student.courseoffer');
Route::get('admin/studentcourse/sendcourseInvoice/{id}', [StudentcourseController::class, 'sendcourseInvoice'])->name('student.sendcourseInvoice');
Route::get('admin/studentcourse/viewReceipt/', [StudentcourseController::class, 'viewReceipt'])->name('studentcourse.viewReceipt');
Route::get('admin/studentcourse/viewStudent/', [StudentcourseController::class, 'view_student'])->name('studentcourse.viewStudent');
Route::get('admin/studentcourse/viewInvoice/', [StudentcourseController::class, 'view_invoice'])->name('studentcourse.viewInvoice');
Route::get('admin/studentcourse/viewOffer/', [StudentcourseController::class, 'view_offer'])->name('studentcourse.viewOffer');


Route::post('admin/studentcourse/store/', [StudentcourseController::class, 'store'])->name('studentcourse.store');
Route::post('admin/studentcourse/storeInvoice/', [StudentcourseController::class, 'storeInvoice'])->name('studentcourse.storeInvoice');

Route::get('admin/studentcourse/invoice/', [StudentcourseController::class, 'invoice'])->name('studentcourse.invoice');
Route::get('admin/bank/', [BankController::class, 'index'])->name('bank.index');
Route::get('admin/bank/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
Route::post('admin/bank/update/{id}', [BankController::class, 'update'])->name('bank.update');

Route::get('admin/sponsor/', [SponsorController::class, 'index'])->name('sponsor.index');
Route::get('education/pay-sponsor/{id}', [EducationController::class, 'sponsor_pay'])->name('sponsor.pay');

Route::post('edit-profile', [EducationController::class, 'store']);
Route::post('student-course', [AuthControllers::class, 'studentCoursestore'])->name('student.course');

Route::get('education/create-step-one',[EducationController::class, 'createStepOne'])->name('education.create.step.one');
Route::post('education/create-step-one',[EducationController::class, 'postCreateStepOne'])->name('education.create.step.one.post');
Route::get('education/course-offer',[EducationController::class, 'getCourseOffers'])->name('education.course.offer');
Route::get('education/view-student',[EducationController::class, 'getStudents'])->name('education.view.student');
Route::get('education/view-sponsered',[EducationController::class, 'getsponseredStudents'])->name('education.sponsored.student');
Route::post('education/add-sponsor',[EducationController::class, 'insert_sponsor'])->name('education.sponsor');
Route::post('searchSponsor',[EducationController::class, 'searchSponsor'])->name('searchSponsor');


Route::get('education/create-step-two',  [EducationController::class, 'createStepTwo'])->name('education.create.step.two');
Route::get('education/reupload',  [EducationController::class, 'reupload'])->name('education.reupload');
Route::post('education/create-step-two', [EducationController::class, 'postCreateStepTwo'])->name('education.create.step.two.post');
Route::get('education/screendocuments', [EducationController::class, 'screendocuments'])->name('education.screendocuments');
Route::post('education/screendocuments/obtain', [EducationController::class, 'obtain'])->name('education.obtain');
Route::post('education/screendocuments/send', [EducationController::class, 'send'])->name('education.send');
Route::get('education/docstatus', [EducationController::class, 'docstatus'])->name('education.docstatus');



Route::get('education/create-step-three', [EducationController::class, 'createStepThree'])->name('products.create.step.three');
Route::post('education/create-step-three', [EducationController::class, 'postCreateStepThree'])->name('products.create.step.three.post');
Route::post('approve/{id}', [AuthControllers::class, 'approve'])->name('approve');
Route::post('decline/{id}', [AuthControllers::class, 'decline'])->name('decline');

Route::get('education/courseApproved', [AuthControllers::class, 'approve_course'])->name('courseApproved');
Route::get('education/courseDenied', [AuthControllers::class, 'deny_course'])->name('courseDenied');
Route::get('education/courseDefer', [AuthControllers::class, 'defer_course'])->name('courseDefer');




Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/reports/registeredstudents/', [Registeredstudentscontroller::class, 'index'])->name('admin.reports.registeredstudents.index');
    Route::get('admin/reports/registeredstudents/view/{id}', [Registeredstudentscontroller::class, 'show'])->name('admin.reports.show.show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/reports/confirmedstudents/', [confirmedstudentscontroller::class, 'index'])->name('admin.reports.confirmedstudents.index');
    Route::get('admin/reports/confirmedstudents/view/{id}', [confirmedstudentscontroller::class, 'confirmedshow'])->name('admin.reports.confirmedshow.confirmedshow');
});

/** Additional Fee **/

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/additionalfee/', [Additionalfeecontroller::class, 'index'])->name('admin.additionalfee.index');
    Route::get('admin/additionalfee/create', [Additionalfeecontroller ::class, 'create'])->name('admin.additionalfee.create');
    Route::post('admin/additionalfee/store', [Additionalfeecontroller ::class, 'store'])->name('admin.additionalfee.store');
    Route::delete('admin/additionalfee/{id}/delete', [Additionalfeecontroller ::class, 'delete'])->name('additionalfee.delete');
    Route::get('admin/additionalfee/edit/{id}', [Additionalfeecontroller::class, 'edit'])->name('admin.additionalfee.edit');
    Route::post('admin/additionalfee/edit/{id}/update', [Additionalfeecontroller ::class, 'update'])->name('admin.additionalfee.update');
   });

   /** Sem Fee **/

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/sem/', [Semcontroller::class, 'index'])->name('admin.sem.index');
    Route::get('admin/sem/create', [Semcontroller ::class, 'create'])->name('admin.sem.create');
    Route::post('admin/sem/store', [Semcontroller ::class, 'store'])->name('admin.sem.store');
    Route::delete('admin/sem/{id}/delete', [Semcontroller ::class, 'delete'])->name('sem.delete');
    Route::get('admin/sem/edit/{id}', [Semcontroller::class, 'edit'])->name('admin.sem.edit');
    Route::post('admin/sem/edit/{id}/update', [Semcontroller ::class, 'update'])->name('admin.sem.update');
   });

/** Pages **/
Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/pages/', [Pagescontroller ::class, 'index'])->name('admin.pages.index');
    Route::get('admin/pages/create', [Pagescontroller ::class, 'create'])->name('admin.pages.create');
    Route::post('admin/pages/store', [Pagescontroller ::class, 'store'])->name('admin.pages.store');
    Route::delete('admin/pages/delete/{id}', [Pagescontroller ::class, 'destroy'])->name('admin.pages.destroy');
    Route::get('admin/pages/edit/{id}', [Pagescontroller ::class, 'edit'])->name('admin.pages.edit');
    Route::post('admin/pages/edit/{id}/update', [Pagescontroller ::class, 'update'])->name('admin.pages.update');
    
});


Route::get('{pages_slug}',[Pagescontroller::class, 'viewpage'])->name('front.page.view');

/** Navigation Menu **/
Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/menuitems/', [Menuitemscontroller ::class, 'index'])->name('admin.menuitems.index');
    Route::get('admin/menuitems/create', [Menuitemscontroller ::class, 'create'])->name('admin.menuitems.create');
    Route::post('admin/menuitems/store', [Menuitemscontroller ::class, 'store'])->name('admin.menuitems.store');
    Route::delete('admin/menuitems/{id}/delete', [Menuitemscontroller ::class, 'destroy'])->name('admin.menuitems.destroy');
    Route::get('admin/menuitems/{id}/edit', [Menuitemscontroller ::class, 'edit'])->name('admin.menuitems.edit');
    Route::post('admin/menuitems/{id}/edit/update', [Menuitemscontroller ::class, 'update'])->name('admin.menuitems.update');
   
    
});

/** Units **/

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/units/', [Unitcontroller::class, 'index'])->name('admin.units.index');
    Route::get('admin/units/create', [Unitcontroller ::class, 'create'])->name('admin.units.create');
    Route::post('admin/units/store', [Unitcontroller ::class, 'store'])->name('admin.units.store');
    Route::delete('admin/units/{id}/delete', [Unitcontroller ::class, 'destroy'])->name('units.destroy');
    Route::get('admin/units/{id}/edit', [Unitcontroller::class, 'edit'])->name('admin.units.edit');
    Route::post('admin/units/{id}/edit/update', [Unitcontroller ::class, 'update'])->name('admin.units.update');
   });


/**Grade Backend**/
Route::get('admin/grade', 'App\Http\Controllers\Admin\GradeController@index')->name('grade.index');
Route::get('admin/grade/create', 'App\Http\Controllers\Admin\GradeController@create')->name('grade.create');
Route::post('admin/grade/store', 'App\Http\Controllers\Admin\GradeController@store')->name('grade.store');
Route::post('admin/grade/destroy/{id}', 'App\Http\Controllers\Admin\GradeController@destroy')->name('grade.destroy');
Route::get('admin/grade/show/{id}', 'App\Http\Controllers\Admin\GradeController@show')->name('grade.show');
Route::get('admin/grade/edit/{id}', 'App\Http\Controllers\Admin\GradeController@edit')->name('grade.edit');
Route::post('admin/grade/update/{id}', 'App\Http\Controllers\Admin\GradeController@update')->name('grade.update');

/**Assignment Backend**/
Route::get('admin/assignment', 'App\Http\Controllers\Admin\AssignmentController@index')->name('assignment.index');
Route::get('admin/assignment/create', 'App\Http\Controllers\Admin\AssignmentController@create')->name('assignment.create');
Route::post('admin/assignment/store', 'App\Http\Controllers\Admin\AssignmentController@store')->name('assignment.store');
Route::post('admin/assignment/destroy/{id}', 'App\Http\Controllers\Admin\AssignmentController@destroy')->name('assignment.destroy');
Route::get('admin/assignment/show/{id}', 'App\Http\Controllers\Admin\AssignmentController@show')->name('assignment.show');
Route::get('admin/assignment/edit/{id}', 'App\Http\Controllers\Admin\AssignmentController@edit')->name('assignment.edit');
Route::get('admin/assignment/update/{id}', 'App\Http\Controllers\Admin\AssignmentController@update')->name('assignment.update');

/**Student Assignment Front */
Route::get('front/assignment', 'App\Http\Controllers\Front\StudentAssignmentController@index')->name('studentassignment.index');

/**Student Assignment Submission Front */
Route::get('front/assignmentsubmission/submit/{id}', 'App\Http\Controllers\Front\AssignmentsubmissionController@submit')->name('assignmentsubmit.submit');
Route::post('front/assignmentsubmission/store/', 'App\Http\Controllers\Front\AssignmentsubmissionController@store')->name('assignmentsubmit.store');

/**Assignmentgrade Backend**/
Route::get('admin/assignmentgrade/', 'App\Http\Controllers\Admin\AssignmentGradeController@index')->name('assignmentgrade.index');
Route::get('admin/assignmentgrade/grade/{id}', 'App\Http\Controllers\Admin\AssignmentGradeController@grade')->name('assignmentgrade.grade');
Route::get('admin/assignmentgrade/store/', 'App\Http\Controllers\Admin\AssignmentGradeController@store')->name('assignmentgrade.store');

/**Exam Backend */
Route::get('admin/exam', 'App\Http\Controllers\Admin\ExamController@index')->name('exam.index');
Route::get('admin/exam/create', 'App\Http\Controllers\Admin\ExamController@create')->name('exam.create');
Route::post('admin/exam/store', 'App\Http\Controllers\Admin\ExamController@store')->name('exam.store');
Route::get('admin/exam/show/{id}', 'App\Http\Controllers\Admin\ExamController@show')->name('exam.show');
Route::get('admin/exam/edit/{id}', 'App\Http\Controllers\Admin\ExamController@edit')->name('exam.edit');
Route::get('admin/exam/update/{id}', 'App\Http\Controllers\Admin\ExamController@update')->name('exam.update');
Route::post('admin/exam/destroy/{id}', 'App\Http\Controllers\Admin\ExamController@destroy')->name('exam.destroy');

/**Student View Exam Details Front */
Route::get('front/studentexam', 'App\Http\Controllers\Front\StudentExamController@index')->name('studentexam.index');
Route::get('front/studentexam/show/{id}', 'App\Http\Controllers\Front\StudentExamController@show')->name('studentexam.show');

/**Reporting Controller */
Route::get('admin/reports/documented', 'App\Http\Controllers\Admin\Reportingcontroller@index')->name('reports.documented');
Route::get('admin/reports/offerd', 'App\Http\Controllers\Admin\Reportingcontroller@offer')->name('reports.offerd');
Route::get('admin/reports/invoice', 'App\Http\Controllers\Admin\Reportingcontroller@sent_invoice')->name('reports.invoice');




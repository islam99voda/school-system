<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
// routes/web.php
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', 'HomeController@index')->middleware('guest')->name('selection');


Route::group(['namespace' => 'Auth'], function () {

Route::get('/login/{type?}',[LoginController::class, 'loginform'])->middleware('guest')->name('login.show');

Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');


});



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function () {

    // ==============================Admin dashboard============================

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    // ==============================dashboard============================


    Route::namespace('Grades')->group(function () {
        Route::resource('Grades', 'GradeController');
    });

    // ==============================Classrooms============================
    Route::namespace('Classrooms')->group(function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });

    // ==============================Sections============================
    Route::namespace('Sections')->group(function () {
        Route::resource('Sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');
        Route::get('/Get_students_table/{Grade_id}/{Classroom_id}/{section_id}', 'SectionController@Get_students_table');

    });

    // ==============================parents============================
    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

    // ==============================Teachers============================
    Route::namespace('Teachers')->group(function () {
        Route::resource('Teachers', 'TeacherController');
    });

    // ==============================Students============================
    Route::namespace('Students')->group(function () {
        Route::resource('Students', 'StudentController');
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
        Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        Route::get('Open_attachment/{studentsname}/{filename}', 'StudentController@Open_attachment')->name('Open_attachment');
        Route::resource('Promotion', 'PromotionController');
        Route::resource('Graduated', 'GraduatedController');
        Route::resource('Fees', 'FeesController');
        Route::resource('Fees_Invoices', 'FeesInvoicesController');
        Route::resource('receipt_students', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
        Route::resource('Payment_students', 'PaymentController');
        Route::resource('Attendance', 'AttendanceController');
        Route::get('/indirect', 'OnlineClasseController@indirectCreate')->name('indirect.create');
        Route::post('/indirect', 'OnlineClasseController@storeIndirect')->name('indirect.store');
        Route::resource('online_classes', 'OnlineClasseController');
        Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
        Route::resource('library', 'LibraryController');
        Route::get('file/{filename}', 'LibraryController@show')->name('file.show');
    });

    // ==============================Subjects============================
    Route::group(['namespace' => 'Subjects'], function () {
        Route::resource('subjects', 'SubjectController');
    });

    //==============================Quizzes============================
    Route::group(['namespace' => 'Quizzes'], function () {
        Route::resource('Quizzes', 'QuizzController');
    });


    //==============================questions============================
    Route::group(['namespace' => 'questions'], function () {
        Route::resource('questions', 'QuestionController');
    });

    //==============================Setting============================
    Route::resource('settings', 'SettingController');

});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

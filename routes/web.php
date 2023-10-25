<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', function () {
    return view('auth.login');
});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    // ==============================dashboard============================
    Route::get('/', fn() => view('dashboard'));

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
    });
});













Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

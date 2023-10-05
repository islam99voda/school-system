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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
            
    //==============================dashboard============================
        Route::get('/', function () {
            return view('dashboard');
        });
    //==============================dashboard============================
        Route::group(['namespace' => 'Grades'], function () {
            Route::resource('Grades', 'GradeController');
        });
    //==============================Classrooms============================
    Route::group(['namespace' => 'Classrooms'], function () {
    Route::resource('Classrooms', 'ClassroomController');
    Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
    Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });
     //==============================Sections============================
     Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');

});
    //==============================parents============================
    Route::view('add_parent','livewire.show_Form')->name('add_parent');
    
    //==============================Teachers============================
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeacherController');
    });

});
    













<?php

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


Route::prefix('admin')->group(function () {
    Route::get('/index', 'AdminController@index');

    Route::prefix('lesson')->group(function () {
        Route::get('/index', 'AdminLessonController@index')->name('admin-lesson-index');
        Route::get('/create', 'AdminLessonController@create');
        Route::post('/store', 'AdminLessonController@store');
        Route::get('/show', 'AdminLessonController@show');
        Route::get('/edit', 'AdminLessonController@edit');
        Route::get('/update', 'AdminLessonController@update');
        Route::get('/delete/{id}', 'AdminLessonController@delete');
    });

    Route::prefix('lesson_date')->group(function () {
        Route::post('/edit', 'AdminLessonDateController@edit');
        Route::post('/update', 'AdminLessonDateController@update');
        Route::get('/delete/{id}', 'AdminLessonDateController@delete');
    });


    Route::prefix('teacher')->group(function () {
        Route::get('/index', 'AdminTeacherController@index')->name('admin-teacher-index');
        Route::get('/create', 'AdminTeacherController@create')->name('admin-teacher-create');
        Route::post('/store', 'AdminTeacherController@store')->name('admin-teacher-store');
        Route::get('/show', 'AdminTeacherController@show')->name('admin-teacher-show');
        Route::get('/edit/{id}', 'AdminTeacherController@edit')->name('admin-teacher-edit');
        Route::post('/update/{id}', 'AdminTeacherController@update')->name('admin-teacher-update');
        Route::get('/destroy', 'AdminTeacherController@destroy')->name('admin-teacher-delete');
        Route::prefix('availability')->group(function () {
            Route::get('/index', 'AdminTeacherAvailabilityController@index')->name('admin-teacherAvailability-index');
            Route::get('/create', 'AdminTeacherAvailabilityController@create')->name('admin-teacherAvailability-create');
            Route::post('/store', 'AdminTeacherAvailabilityController@store')->name('admin-teacherAvailability-store');
            Route::get('/show', 'AdminTeacherAvailabilityController@show')->name('admin-teacherAvailability-show');
            Route::get('/edit', 'AdminTeacherAvailabilityController@edit')->name('admin-teacherAvailability-edit');
            Route::get('/update', 'AdminTeacherAvailabilityController@update')->name('admin-teacherAvailability-update');
            Route::get('/destroy', 'AdminTeacherAvailabilityController@destroy')->name('admin-teacherAvailability-delete');
        });
    });

    Route::prefix('studio')->group(function () {
        Route::get('/index', 'AdminStudioController@index')->name('admin-studio-index');
        Route::get('/create', 'AdminStudioController@create')->name('admin-studio-create');
        Route::post('/store', 'AdminStudioController@store')->name('admin-studio-store');
        Route::get('/show', 'AdminStudioController@show')->name('admin-studio-show');
        Route::get('/edit/{id}', 'AdminStudioController@edit')->name('admin-studio-edit');
        Route::post('/update/{id}', 'AdminStudioController@update')->name('admin-studio-update');
        Route::get('/delete/{id}', 'AdminStudioController@delete')->name('admin-studio-delete');
    });


});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

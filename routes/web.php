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

Route::prefix('student')->group(function () {
    Route::get('/index', 'student\StudentRegistrationController@index');
});

Route::prefix('lesson')->group(function () {
    Route::get('/index', 'student\StudentLessonController@index')->name('lesson-index');
});
Route::get('index', 'student\StudentDashboardController@index')->name('student-dashboard-index');

Route::prefix('account')->group(function () {
    Route::get('edit', 'student\StudentController@edit')->name('student-edit');
    Route::get('update', 'student\StudentController@update')->name('student-update');
    Route::get('appointments', 'student\StudentController@appointments')->name('student-appointments');
});

Route::prefix('lessonDate')->group(function () {
    Route::get('/show/{teacher_id}/{lesson_id}', 'student\StudentLessonDateController@show')->name('student-lessonDate-show');
    Route::get('/showRegistrationForm/{lessonDate_id}', 'student\StudentLessonDateController@showRegistrationForm')->name('student-lessonDate-showRegistrationForm');
    Route::post('/postRegistrationForm', 'student\StudentLessonDateController@postRegistrationForm')->name('student-lessonDate-postRegistrationForm');
    Route::get('/delete/{id}', 'student\StudentLessonDateController@delete')->name('student-lessonDate-delete');
});


Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin-login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin-login-submit');
    //Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/index', 'admin\AdminController@index')->name('admin-dashboard');
    Route::prefix('lesson')->group(function () {
        Route::get('/index', 'admin\AdminLessonController@index')->name('admin-lesson-index');
        Route::get('/create', 'admin\AdminLessonController@create');
        Route::post('/store', 'admin\AdminLessonController@store')->name('admin-lesson-store');
        Route::get('/show/{id}', 'admin\AdminLessonController@show')->name('admin-lesson-show');
        Route::get('/edit/{id}', 'admin\AdminLessonController@edit')->name('admin-lesson-edit');
        Route::post('/update/{id}', 'admin\AdminLessonController@update')->name('admin-lesson-update');
        Route::get('/delete/{id}', 'admin\AdminLessonController@delete')->name('admin-lesson-delete');
    });

    Route::prefix('lessonDate')->group(function () {
        Route::get('/create/{date}/{lesson_id}', 'admin\AdminLessonDateController@create')->name('admin-lessonDate-create');
        Route::post('/store', 'admin\AdminLessonDateController@store');
        Route::get('/edit/{id}', 'admin\AdminLessonDateController@edit');
        Route::post('/update', 'admin\AdminLessonDateController@update');
        Route::get('/delete/{id}', 'admin\AdminLessonDateController@delete')->name('admin-lessonDate-delete');
        Route::get('/registerStudent/{lessonDate_id}/{student_id}', 'admin\AdminLessonDateController@registerStudent')->name('admin-lessonDate-registerStudent');
        Route::get('/cancelStudent/{lessonDate_id}/{LessonDateRegistration_id}', 'admin\AdminLessonDateController@cancelStudent')->name('admin-lessonDate-cancelStudent');
        Route::get('/showRegistrationForm/{lessonDate_id}', 'admin\AdminLessonDateController@showRegistrationForm')->name('admin-lessonDate-showRegistrationForm');
    });

    Route::prefix('student')->group(function () {
        Route::get('/index', 'admin\AdminStudentController@index')->name('admin-student-index');
        Route::get('/create', 'admin\AdminStudentController@create')->name('admin-student-create');
        Route::post('/store', 'admin\AdminStudentController@store')->name('admin-student-store');
        Route::get('/show', 'admin\AdminStudentController@show')->name('admin-student-show');
        Route::get('/edit/{id}', 'admin\AdminStudentController@edit')->name('admin-student-edit');
        Route::post('/update/{id}', 'admin\AdminStudentController@update')->name('admin-student-update');
        Route::get('/delete/{id}', 'admin\AdminStudentController@delete')->name('admin-student-delete');
    });


    Route::prefix('teacher')->group(function () {
        Route::get('/index', 'admin\AdminTeacherController@index')->name('admin-teacher-index');
        Route::get('/create', 'admin\AdminTeacherController@create')->name('admin-teacher-create');
        Route::post('/store', 'admin\AdminTeacherController@store')->name('admin-teacher-store');
        Route::get('/show', 'admin\AdminTeacherController@show')->name('admin-teacher-show');
        Route::get('/edit/{id}', 'admin\AdminTeacherController@edit')->name('admin-teacher-edit');
        Route::post('/update/{id}', 'admin\AdminTeacherController@update')->name('admin-teacher-update');
        Route::get('/delete/{id}', 'admin\AdminTeacherController@delete')->name('admin-teacher-delete');
        Route::prefix('availability')->group(function () {
            Route::get('/index', 'admin\AdminTeacherAvailabilityController@index')->name('admin-teacherAvailability-index');
            Route::get('/create', 'admin\AdminTeacherAvailabilityController@create')->name('admin-teacherAvailability-create');
            Route::post('/store', 'admin\AdminTeacherAvailabilityController@store')->name('admin-teacherAvailability-store');
            Route::get('/show', 'admin\AdminTeacherAvailabilityController@show')->name('admin-teacherAvailability-show');
            Route::get('/edit', 'admin\AdminTeacherAvailabilityController@edit')->name('admin-teacherAvailability-edit');
            Route::get('/update', 'admin\AdminTeacherAvailabilityController@update')->name('admin-teacherAvailability-update');
            Route::get('/destroy', 'admin\AdminTeacherAvailabilityController@destroy')->name('admin-teacherAvailability-delete');
        });
    });

    Route::prefix('studio')->group(function () {
        Route::get('/index', 'admin\AdminStudioController@index')->name('admin-studio-index');
        Route::get('/create', 'admin\AdminStudioController@create')->name('admin-studio-create');
        Route::post('/store', 'admin\AdminStudioController@store')->name('admin-studio-store');
        Route::get('/show', 'admin\AdminStudioController@show')->name('admin-studio-show');
        Route::get('/edit/{id}', 'admin\AdminStudioController@edit')->name('admin-studio-edit');
        Route::post('/update/{id}', 'admin\AdminStudioController@update')->name('admin-studio-update');
        Route::get('/delete/{id}', 'admin\AdminStudioController@delete')->name('admin-studio-delete');
    });
    // });
});

Route::get('/home', 'HomeController@index')->name('home');

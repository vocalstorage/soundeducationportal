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

Route::group(['middleware' => 'auth:student'], function () {
    Route::get('/', 'Student\StudentLessonController@index')->name('student-lesson-index');

    Route::prefix('student')->group(function () {
        Route::get('/index', 'student\StudentRegistrationController@index');

        Route::group(['middleware' => 'auth:student'], function () {
            Route::prefix('lesson')->group(function () {
                Route::get('/index', 'Student\StudentLessonController@index')->name('student-lesson-index');
            });
            Route::get('index', 'student\StudentDashboardController@index')->name('student-dashboard-index');

            Route::prefix('account')->group(function () {
                Route::get('edit', 'Student\StudentController@edit')->name('student-edit');
                Route::post('update', 'Student\StudentController@update')->name('student-update');
                Route::get('appointments', 'Student\StudentController@appointments')->name('student-appointments');
            });

            Route::prefix('lessonDate')->group(function () {
                Route::get('/show/{teacher_id}/{lesson_id}', 'Student\StudentLessonDateController@show')->name('student-lessonDate-show');
            });

            Route::prefix('registration')->group(function () {
                Route::get('/show/{lessonDate_id}', 'Student\StudentRegistrationController@show')->name('student-registration-show');
                Route::post('/store', 'Student\StudentRegistrationController@store')->name('student-registration-store');
                Route::get('/delete/{id}', 'Student\StudentRegistrationController@delete')->name('student-registration-delete');
                Route::post('/update/{id}', 'Student\StudentRegistrationController@update')->name('student-registration-update');
            });
        });
    });
});


Route::prefix('admin')->group(function () {
    Route::get('/login', 'Admin\AdminLoginController@showLoginForm')->name('admin-login');
    Route::post('/login', 'Admin\AdminLoginController@login')->name('admin-login-submit');

    Route::group(['middleware' => 'auth:admin'], function () {

        Route::get('/index', 'Admin\AdminController@index')->name('admin-dashboard');

        Route::prefix('lesson')->group(function () {
            Route::get('/index', 'Admin\AdminLessonController@index')->name('admin-lesson-index');
            Route::get('/create', 'Admin\AdminLessonController@create')->name('admin-lesson-create');
            Route::post('/store', 'Admin\AdminLessonController@store')->name('admin-lesson-store');
            Route::get('/show/{id}', 'Admin\AdminLessonController@show')->name('admin-lesson-show');
            Route::get('/showWarning/{id}', 'Admin\AdminLessonController@showWarning')->name('admin-lesson-show-warning');
            Route::get('/edit/{id}', 'Admin\AdminLessonController@edit')->name('admin-lesson-edit');
            Route::post('/update/{id}', 'Admin\AdminLessonController@update')->name('admin-lesson-update');
            Route::get('/presenece/{id}', 'Admin\AdminLessonController@presence')->name('admin-lesson-presence');
            Route::get('/delete/{id}', 'Admin\AdminLessonController@delete')->name('admin-lesson-delete');

        });

        Route::prefix('lessonDate')->group(function () {
            Route::get('/create/{date}/{lesson_id}', 'Admin\AdminLessonDateController@create')->name('admin-lessonDate-create');
            Route::post('/store', 'Admin\AdminLessonDateController@store');
            Route::get('/edit/{id}', 'Admin\AdminLessonDateController@edit');
            Route::post('/update', 'Admin\AdminLessonDateController@update');
            Route::get('/delete/{id}', 'Admin\AdminLessonDateController@delete')->name('admin-lessonDate-delete');
            Route::post('/handle', 'Admin\AdminLessonDateController@handleWarnings')->name('admin-lessonDate-handleWarnings');
            Route::get('/handleWarning/{warningId}/{type}', 'Admin\AdminLessonDateController@handleWarning')->name('admin-lessonDate-handleWarning');
            Route::post('/multipleDelete', 'Admin\AdminLessonDateController@multipleDelete')->name('admin-lessonDate-multipleDelete');
            Route::get('/registerStudent/{lessonDate_id}/{student_id}', 'Admin\AdminLessonDateController@registerStudent')->name('admin-lessonDate-registerStudent');
            Route::get('/cancelStudent/{lessonDate_id}/{LessonDateRegistration_id}', 'Admin\AdminLessonDateController@cancelStudent')->name('admin-lessonDate-cancelStudent');
            Route::get('/showRegistrationForm/{lessonDate_id}', 'Admin\AdminLessonDateController@showRegistrationForm')->name('admin-lessonDate-showRegistrationForm');
            Route::post('/handlePresence', 'Admin\AdminLessonDateController@handlePresence')->name('admin-lessonDate-handlePresence');
        });

        Route::prefix('schoolgroup')->group(function () {
            Route::get('/index', 'Admin\AdminSchoolgroupController@index')->name('admin-schoolgroup-index');
            Route::get('/create', 'Admin\AdminSchoolgroupController@create')->name('admin-schoolgroup-create');
            Route::post('/store', 'Admin\AdminSchoolgroupController@store')->name('admin-schoolgroup-store');
            Route::get('/show', 'Admin\AdminSchoolgroupController@show')->name('admin-schoolgroup-show');
            Route::get('/edit/{id}', 'Admin\AdminSchoolgroupController@edit')->name('admin-schoolgroup-edit');
            Route::post('/update/{id}', 'Admin\AdminSchoolgroupController@update')->name('admin-schoolgroup-update');
            Route::get('/delete/{id}', 'Admin\AdminSchoolgroupController@delete')->name('admin-schoolgroup-delete');
        });


        Route::prefix('teacher')->group(function () {
            Route::get('/index', 'Admin\AdminTeacherController@index')->name('admin-teacher-index');
            Route::get('/create', 'Admin\AdminTeacherController@create')->name('admin-teacher-create');
            Route::post('/store', 'Admin\AdminTeacherController@store')->name('admin-teacher-store');
            Route::get('/show', 'Admin\AdminTeacherController@show')->name('admin-teacher-show');
            Route::get('/edit/{id}', 'Admin\AdminTeacherController@edit')->name('admin-teacher-edit');
            Route::post('/update/{id}', 'Admin\AdminTeacherController@update')->name('admin-teacher-update');
            Route::get('/delete/{id}', 'Admin\AdminTeacherController@delete')->name('admin-teacher-delete');
        });

        Route::prefix('studio')->group(function () {
            Route::get('/index', 'Admin\AdminStudioController@index')->name('admin-studio-index');
            Route::get('/create', 'Admin\AdminStudioController@create')->name('admin-studio-create');
            Route::post('/store', 'Admin\AdminStudioController@store')->name('admin-studio-store');
            Route::get('/show', 'Admin\AdminStudioController@show')->name('admin-studio-show');
            Route::get('/edit/{id}', 'Admin\AdminStudioController@edit')->name('admin-studio-edit');
            Route::post('/update/{id}', 'Admin\AdminStudioController@update')->name('admin-studio-update');
            Route::get('/delete/{id}', 'Admin\AdminStudioController@delete')->name('admin-studio-delete');
        });
        Route::prefix('student')->group(function () {
            Route::get('/delete/{id}', 'Admin\AdminStudentController@delete')->name('admin-student-delete');
        });
    });
});


Route::prefix('teacher')->group(function () {
    Route::get('/login', 'Teacher\TeacherLoginController@showLoginForm')->name('teacher-login');
    Route::post('/login', 'Teacher\TeacherLoginController@login')->name('teacher-login-submit');

    Route::group(['middleware' => 'auth:teacher'], function () {
        Route::get('/index', 'Teacher\TeacherController@index')->name('teacher-dashboard');

        Route::prefix('lesson')->group(function () {
            Route::get('/index', 'Teacher\TeacherLessonController@index')->name('teacher-lesson-index');
            Route::get('/show/{id}/{calendarView}', 'Teacher\TeacherLessonController@show')->name('teacher-lesson-show');
            Route::get('/presenece/{id}', 'Teacher\TeacherLessonController@presence')->name('teacher-lesson-presence');
        });

        Route::prefix('lessonDate')->group(function () {
            Route::get('/create/{date}/{lesson_id}', 'Teacher\TeacherLessonDateController@create')->name('teacher-lessonDate-create');
            Route::post('/store', 'Teacher\TeacherLessonDateController@store');
            Route::get('/edit/{id}', 'Teacher\TeacherLessonDateController@edit');
            Route::post('/update', 'Teacher\TeacherLessonDateController@update');
            Route::get('/delete/{id}', 'Teacher\TeacherLessonDateController@delete')->name('teacher-lessonDate-delete');
            Route::post('/handlePresence', 'Teacher\TeacherLessonDateController@handlePresence')->name('teacher-lessonDate-handlePresence');
            Route::get('/showRegistrationForm/{lessonDate_id}', 'Teacher\TeacherLessonDateController@showRegistrationForm')->name('teacher-lessonDate-showRegistrationForm');
        });

        Route::prefix('studio')->group(function () {
            Route::post('/update', 'Teacher\TeacherStudioController@update')->name('teacher-studio-update');
        });


//        Route::prefix('registration')->group(function(){
//            Route::get('/show/{lessonDate_id}', 'Admin\AdminRegistrationController@show')->name('Admin-registration-show');
//            Route::get('/store/{lessonDate_id}/{student_id}', 'Admin\AdminRegistrationController@store')->name('Admin-registration-store');
//            Route::get('/delete/{lessonDate_id}/{LessonDateRegistration_id}', 'Admin\AdminRegistrationController@delete')->name('Admin-registration-delete');
//            Route::post('/update', 'Admin\AdminRegistrationController@update')->name('Admin-registration-update');
//            Route::post('/handlePresence', 'Admin\AdminRegistrationController@handlePresence')->name('Admin-registration-handlePresence');
//        });

        Route::prefix('account')->group(function () {
            Route::get('edit', 'Teacher\TeacherController@edit')->name('teacher-edit');
            Route::post('update', 'Teacher\TeacherController@update')->name('teacher-update');
        });
    });
});

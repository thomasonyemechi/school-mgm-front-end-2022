<?php

use App\Http\Controllers\MiscellaneousController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'control', 'as'=>'control.', 'middleware' => ['auth2'] ], function (){
    Route::get('/dashboard', function () {
        return view('control.admin_dashboard');
    });

    Route::get('/general_setup', function () {
        return view('control.general_setup2');
    });

    Route::get('/add_subject', function () {
        return view('control.add_subject');
    });

    Route::get('/subject_teacher', function () {
        return view('control.view_set_subject_teacher');
    });

    Route::get('/category_arm', function () {
        return view('control.class_category_arm');
    });

    Route::get('/create_class', function () {
        return view('control.create_class');
    });

    Route::get('/class/{class_id}', function ($class_id) {
        return view('control.class_profile', compact('class_id'));
    });

    Route::get('/add_staff', function () {
        return view('control.add_staff');
    });

    Route::get('/staff_profile', function () {
        return view('control.staff_profile');
    });


    Route::get('/register_guardian', function () {
        return view('control.register_guardian');
    });

    Route::get('/guardian_profile', function () {
        return view('control.guardian_profile');
    });

    Route::get('/register_student', function () {
        return view('control.register_student');
    });

    Route::get('/all_student', function () {
        return view('control.all_student');
    });


    Route::get('/student/{student_id}', function ($student_id) {
        return view('control.student_profile', compact('student_id'));
    });


    Route::get('/daily_fee_payment', function () {
        return view('control.payment_daily');
    });

    Route::get('/fee', function () {
        return view('control.fee_setting');
    });


    Route::get('/set_fee', function () {
        return view('control.set_school_fee');
    });

    Route::get('/set_fee/{fee}/{class}', function ($fee, $class) {
        return view('control.set_school_fee', compact('fee', 'class'));
    });




    Route::get('/class/fee/{class_id}', function ($class_id) {
        return view('control.class_fee', compact('class_id'));
    });


    Route::get('/class/payments/{class_id}', function ($class_id) {
        return view('control.class_payments', compact('class_id'));
    });



    Route::get('/class/teachers/{class_id}', function ($class_id) {
        return view('control.class_teachers', compact('class_id'));
    });




});


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/give_current_session', function () {
    return session()->get('info');
});


Route::post('/session_login_infomation',[MiscellaneousController::class, 'sessionLoginInfomation'])->name('session_login_infomation');


Route::get('/login', function () {
    return view('/login');
})->name('login');

Route::get('/logout', function () {
    return session()->flush();
});


Route::get('/register', function () {
    return view('/signup');
});

Route::get('/forgot_password', function () {
    return view('/forgot_password');
});

Route::get('/reset_password', function () {
    return view('/reset_password');
});

Route::get('/terms', function () {
    return '</h1>Terms and Conditions</h1>';
});






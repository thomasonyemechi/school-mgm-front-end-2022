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

    Route::group(['middleware' => ['active_term'] ], function (){

        Route::group(['middleware' => ['registration'] ], function (){
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


            Route::get('/student/fee/{student_id}/{term_id?}', function ($student_id, $term_id = 0) {
                return view('control.student_fee', compact('student_id', 'term_id'));
            });
        });

        Route::group(['middleware' => ['fee'] ], function (){
            Route::get('/fee/daily/{day?}', function ($day=0) {
                if($day == 0) { $day = date('Y-m-j'); }
                return view('control.payment_daily', compact('day'));
            });

            Route::get('/fee/weekly/{week?}', function ($week=0) {
                if($week == 0) { $week = date('w'); }
                return view('control.payment_weekly', compact('week'));
            });

            Route::get('/fee/termly/{term?}', function ($term=0) {
                return view('control.payment_termly', compact('term'));
            });


            Route::get('/fee/range/{from?}/{to?}', function ($from='', $to='') {
                return view('control.payment_date_range', compact(['from', 'to']));
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
        });

        Route::group(['middleware' => ['other'] ], function (){
            Route::get('/setting/permission', function () {
                return view('control.permission_settings');
            });

            Route::get('/setting/result', function () {
                return view('control.result_setup');
            });

            Route::get('/add_subject', function () {
                return view('control.add_subject');
            });

            Route::get('/subject/assign', function () {
                return view('control.view_set_subject_teacher2');
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

            Route::get('/result/check/{student_id?}', function ($student_id=0) {
                return view('control.checkresult', compact('student_id'));
            });


            Route::get('/result/class/{class_id?}', function ($class_id=0) {
                return view('control.class_result', compact('class_id'));
            });


            Route::get('/result/print/{class_id?}', function ($class_id=0) {
                return view('control.print_class_result', compact('class_id'));
            });



            Route::get('/result/print/s/{result_id?}', function ($result_id=0) {
                return view('control.print_student_result', compact('result_id'));
            });





            Route::get('/view-result/{result_id}', function ($result_id) {
                return view('control.result-view', compact('result_id'));
            });
        });




        Route::get('/dashboard', function () {
            return view('control.admin_dashboard');
        });

        Route::get('/result/upload/{program?}', function ($program=0) {
            return view('control.enter_result', compact('program'));
        });

        Route::get('/broad-sheet/{program?}', function ($program=0) {
            return view('control.broad_sheet', compact('program'));
        });

        Route::get('class/broad-sheet/{program}', function ($program=0) {
            return view('control.admin_check_broad_sheet', compact('program'));
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





    Route::get('/setting/general', function () {
        return view('control.general_setup2');
    })->middleware('other');


    Route::get('/setting/sub/{term_id}', function ($term_id=0) {
        return view('control.subscription', compact('term_id'));
    })->middleware('other');



    Route::get('/setting/renew/{term_id}', function ($term_id=0) {
        return view('control.renwesub', compact('term_id'));
    })->middleware('other');





    Route::get('/tem/1', function () {
        return view('control.result_template_1');
    });


});


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/give_current_session', function () {
    return session()->get('info');
});


Route::post('/session_login_infomation',[MiscellaneousController::class, 'sessionLoginInfomation']);
Route::post('/reput_term', [MiscellaneousController::class, 'reputTerm']);




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

Route::get('/logout', function () {
    session()->flush();
    return redirect('/login')->with('success' , 'You have been logged out');
});

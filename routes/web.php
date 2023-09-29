<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OscarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*ログイン画面*/
Route::get('/', function () {
    return view('displays/portal');
});
Route::get('/', [OscarController::class, 'portal'])->name('displays/portal');
Route::post('/login', [OscarController::class, 'login'])->name('displays/login');
Route::post('/home', [OscarController::class, 'login'])->name('displays/home');
Route::post('/home_general', [OscarController::class, 'login'])->name('displays/home_general');


/*トップページ（管理者ユーザ）*/
Route::get('/home', function () {
    return view('displays/home');
});
Route::get('/home', [OscarController::class, 'index']);

/*トップページ（一般ユーザ）*/
Route::get('/home_general', function () {
    return view('displays/home_general');
});


/*出勤報告*/
Route::get('/clockin', [OscarController::class, 'showClockinForm'])->name('clockin.show');
Route::post('/clockin', [OscarController::class, 'store'])->name('attendance.store');


/*退勤報告*/
Route::post('/clockout', [OscarController::class, 'store'])->name('attendance.store');
Route::get('/clockout', function () {
    return view('displays/clockout');
});




/*社員追加登録*/
Route::get('/user_entry', [OscarController::class, 'showUserEntryForm'])->name('user_entry');
Route::post('/register_user', [OscarController::class, 'registerUser'])->name('register_user');
Route::get('/user_entry', function () {
    return view('displays/user_entry');
});

/*社員追削除*/
Route::delete('/user_delete/{id}', [OscarController::class, 'deleteUser']);


/*社員編集*/
Route::get('/user_edit/{id}', [OscarController::class, 'edit']);
Route::post('/user_update/{id}', [OscarController::class, 'update']);
Route::get('/user_edit', function () {
    return view('displays/user_edit');
});


/*勤怠状況一覧*/
Route::get('/attendance', [OscarController::class, 'showAttendanceList']);




/*有給申請*/
Route::get('/paid', [OscarController::class, 'showPaidForm'])->name('paid_form.show');
Route::post('/application_general', [OscarController::class, 'submitApplication'])->name('submit-application');
Route::match(['get', 'post'], '/application_general', [OscarController::class, 'submitApplication'])->name('submit-application');



/*有給申請一覧（一般ユーザ）*/
Route::get('/application_general', function () {
    return view('displays/application_general');
});
Route::get('/application_general', [OscarController::class, 'showApplications']);


/*有給申請一覧（管理者ユーザ）*/
Route::get('/application', function () {
    return view('displays/application');
});
Route::get('/application', [OscarController::class, 'showApplicationsForAnotherUrl']);
Route::get('/application', [OscarController::class, 'showApplicationsForAnotherUrl'])->name('displays.application');




/*有給申請編集*/
Route::get('/paid_edit', function () {
    return view('displays/paid_edit');
});
Route::get('/paid_edit/{id}', [OscarController::class, 'paidedit'])->name('paid.edit');
Route::post('/paid_update/{id}', [OscarController::class, 'paidupdate'])->name('paid.update');




Route::post('/attendance', [OscarController::class, 'extractAttendance'])
    ->name('extract.attendance');













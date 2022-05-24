<?php

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
//Route::view('/', 'welcome');
// Route::get('/', function () {
//    // return redirect()->route('login');
//     return view('welcome');
// });


include 'admin.php';
include 'student.php';
 Route::redirect('/', '/home');
Auth::routes();
Route::post('/otp-request', 'App\Http\Controllers\Auth\RegisterController@otpRequest')->name('send_otp_request');

Route::get('/otp-form', 'App\Http\Controllers\Auth\RegisterController@otpForm')->name('otp-form');
Route::get('/admin/login', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/resend-otp', 'App\Http\Controllers\Auth\RegisterController@resendOtp')->name('resent-otp');
Route::post('admin/login', 'App\Http\Controllers\Admin\LoginController@login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('pages', App\Http\Controllers\PagesController::class);

Route::resource('admins', App\Http\Controllers\AdminController::class);

 Route::get('mark-read/{id}', [
     'as'   => 'user.notification.markread',
     'uses' => 'App\Http\Controllers\User\DashboardController@readNotification',
 ]);                    




Route::resource('couriers', App\Http\Controllers\CourierController::class);


Route::resource('wardens', App\Http\Controllers\WardenController::class);

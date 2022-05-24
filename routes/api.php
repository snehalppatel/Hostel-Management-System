<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['middleware' => ['student_auth']], function () {
    Route::resource('students', 'StudentAPIController');
// });
Route::post('auth/login', 'AuthAPIController@login');
Route::get('pages/check_slug', 'PagesAPIController@check_slug')
  ->name('pages.check_slug');
Route::get('pages/find/{slug}', 'PagesAPIController@viewPage')
  ->name('pages.getpage');
Route::resource('pages', 'PagesAPIController');


Route::resource('admins', App\Http\Controllers\API\AdminAPIController::class);


Route::resource('leaves', App\Http\Controllers\API\LeaveAPIController::class);

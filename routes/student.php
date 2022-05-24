<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\User','middleware' => 'auth:web'], function (Router $router) {
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    

    // $router->get('home', [
    //     'as'   => 'home',
    //     'uses' => 'DashboardController@viewProfile',
    // ]);         
    Route::redirect('home', 'my-profile');
    $router->get('dashboard', [
        'as'   => 'user.dashboard',
        'uses' => 'DashboardController@dashboard',
    ]); 
    $router->get('profile', [
        'as'   => 'user.profile',
        'uses' => 'DashboardController@profile',
    ]);            
    $router->get('my-profile', [
        'as'   => 'user.view.profile',
        'uses' => 'DashboardController@viewProfile',
    ]);                
    $router->post('profile/update', [
        'as'   => 'user.profile.update',
        'uses' => 'DashboardController@updateProfile',
    ]);            
    $router->get('notifications', [
        'as'   => 'user.notifications',
        'uses' => 'DashboardController@notification',
    ]);                

});
Route::group(['namespace' => 'App\Http\Controllers','middleware' => 'auth:web'], function (Router $router){
    Route::resource('leaves', LeaveController::class);                            
    Route::resource('outings', OutingController::class);
   }); 
?>
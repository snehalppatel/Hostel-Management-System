<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::post('admin/login', 'App\Http\Controllers\Admin\LoginController@login');


$router->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers', 'middleware' => ['auth:admin']], function (Router $router) {

    $router->get('/', [
        'as'   => 'admin.register',
        'uses' => 'Admin\DashboardController@index',
    ]);
        
    $router->get('dashboard', [
        'as'   => 'admin.dashboard',
        'uses' => 'Admin\DashboardController@index',
    ]);   
    Route::resource('students', StudentController::class);    
    // Route::resource('leaves', LeaveController::class);                            
    // Route::resource('outings', OutingController::class);    
    $router->get('leaves/', [
        'as'   => 'admin.leaves.index',
        'uses' => 'LeaveController@allLeaves',
    ]);    
    $router->get('outings/', [
        'as'   => 'admin.outings.index',
        'uses' => 'OutingController@allOuting',
    ]);        
});

?>

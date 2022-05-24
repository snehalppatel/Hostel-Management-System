<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:tribe_owner')->except('logout');        
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function index(){
        return view('admin.login');
    }

    public function login(Request $request)
    {

        if ($this->guardLogin($request, 'admin')) {
            return redirect()->intended('/admin/students');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function guardLogin(Request $request, $guard)
    {
        $this->validator($request);

        return Auth::guard($guard)->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        );
    }    

    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'email'   => 'required|email|exists:admins',
            'password' => 'required|min:6'
        ]);
    }

        
}

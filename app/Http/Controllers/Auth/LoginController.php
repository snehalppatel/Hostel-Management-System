<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->roll_number = $this->findUsername();                
    }


    public function findUsername()
    {
        $login = request()->input('email');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'roll_number';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    protected function credentials(Request $request)
    {

        $field = filter_var($request->get($this->roll_number()), FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'roll_number';

        return [
            $field     => $request->get($this->roll_number()),
            'password' => $request->password,
            // 'is_active' => 1,
        ];
    }


    public function validateLogin(Request $request)
    {
        // dd($this->roll_number());
        if($request->type == 'Student'){
            $request->validate([
                $this->roll_number()     => 'required|string|'.Rule::exists('users',$this->roll_number())                     
        ->where('type', 'Student'),
                'password' => 'required|string',
            ], [
                // 'captcha.captcha' => 'Invalid Captcha',
            ]);
        }else if($request->type == 'Warden'){
            $request->validate([
                'email' => 'required|string|'.Rule::exists('users','email')                     
        ->where('type', 'Warden'),
                'password' => 'required|string',
            ]);            
        }
        else if($request->type == 'Security'){
            $request->validate([
                'email' => 'required|string|'.Rule::exists('users','email')                     
        ->where('type', 'Security'),
                'password' => 'required|string',
            ]);            
        }        
    }

    public function roll_number()
    {
        return $this->roll_number;
    }
            

    public function showAdminLoginForm()
    {
        return view('admin.login', ['url' => 'admin']);
    }   

    public function logout(Request $request )
    {
        if(Auth::guard('admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            $this->guard()->logout();            
            return redirect()->route('login.admin');
        }
        Auth::guard('admin')->logout();
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

}

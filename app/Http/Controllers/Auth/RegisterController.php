<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\User\VerifyMail;
use App\Models\User;
use App\Models\Warden;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        if($data['type'] == 'Student'){
            return Validator::make($data, [
                'type' => ['required'],            
                'roll_number' => ['required', 'string','max:255', 'unique:users'],            
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],            
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:users', 'ends_with:smail.iitpkd.ac.in'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        }else{
            return Validator::make($data, [
                'type' => ['required'],            
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],            
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:users', 'ends_with:smail.iitpkd.ac.in'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function register(Request $request)
    {
        // dd($request->otp);
        if (\Session::get('registration_otp') != $request->otp) {
            return redirect()->back()
                ->withError('Invalid OTP');
        }

        $this->validator($request->all())->validate();
        \Session::forget('registration_otp');
        $this->create($request->all());
        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }
        return redirect()->route('login')->withSuccess('Thank you for register with us! Please login by using Email id or Roll Number. Thanks');        
        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    protected function create(array $data)
    {
        if($data['type'] == 'Student'){
            return User::create([
                'first_name' => $data['first_name'],            
                'last_name' => $data['last_name'],
                'roll_number' => $data['roll_number'],
                // 'city' => $data['city'],                                    
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

        }elseif($data['type'] == 'Warden' || $data['type'] == 'Security'){
            return User::create([
                'first_name' => $data['first_name'],            
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => $data['type'],
            ]);
            
        }
    }

    public function otpRequest(request $request){
        $this->validator($request->all())->validate();        
        \Session::put('register_value', $request->all());

        $generate_otp = mt_rand(1000, 9999);
        \Session::put('registration_otp', $generate_otp);
        $otp = $generate_otp;

        Mail::to($request->input('email'))->send(new VerifyMail($otp));

        return redirect()->route('otp-form')->withSuccess('We have send you OTP to register Email id, Please enter OTP. Thanks');        

        // return view('auth.otp-form', ['url' => 'admin']);

        // return redirect()->route('otp')->withSuccess('We have send you OTP to register Email id, Please enter OTP. Thanks');                
    }

    public function otpForm(Request $request){
        $data = \Session::get('register_value');

        return view('auth.otp-form', compact('data'));        
    }

    public function resendOtp(Request $request){
        $generate_otp = mt_rand(1000, 9999);
        \Session::put('registration_otp', $generate_otp);
        $otp = $generate_otp;

        Mail::to($request->input('email'))->send(new VerifyMail($otp));
        return redirect()->route('otp-form')->withSuccess('OTP send successfully!');                        
    }
}

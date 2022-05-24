<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BoostedPost;
use App\Models\Category;
use App\Models\Country;
use App\Models\Meditation;
use App\Models\Timezone;
use App\Models\TribeOwner;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Storage;
use Flash;

class DashboardController extends Controller
{
	// protected $userRepo;
 //    public function __construct(UserRepository $userRepo)
 //    {
 //        $this->userRepository = $userRepo;    	
 //    }

    public function profile()
    {
        $user = \Auth::guard('web');
        $user = $user->user();

        return view('students.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = \Auth::guard('web');
        $user = $user->user();
        // dd($user);
        $this->validate($request, [
            'password'    => 'nullable|confirmed',
            'first_name'  => 'required',
            'last_name' => 'required',
        ]);


        $input = $request->except('password');

        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->phone = $input['phone'];
        if ($request->has('password') && $request->password != null) {
            $input['password'] = \Hash::make($request->password);
            $user->password = $input['password'];
        }
        // $user->first_name = $input['first_name'];
        $user->save();
        // $tribeOwner = User::where('id', $user->id)->update($input);
        return back()->withSuccess('Profile detail updated successfully.');        

    }
    public function dashboard()
    {
        return view('students.dashboard');
    }

    public function viewProfile(){
        $student = \Auth::guard('web');
        $student = $student->user();
        return view('students.show')->with('student', $student);

    }

    public function notification(){
        $student = \Auth::guard('web');
        $student = $student->user();
        $admin = \Auth::user();


        $notification_data = $admin->notifications;
// dd($notification_data);
        return view('all_notification', compact('notification_data'));        
    }

    public function readNotification($id){

        $user = \Auth::user();

        $user->notifications->where('id', $id)->markAsRead();
   Flash::success('Notification read successfully');        
        return redirect()->route('user.notifications')->withSuccess('Notification read successfully!');
    }

}

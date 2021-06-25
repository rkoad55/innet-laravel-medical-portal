<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\DoctorModel as Doctor;
use Auth;
use Validator;
use App\Events\DoctorVerification;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    protected $redirectTo = 'doctor/dashboard';

    public function __construct()
    {
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showLoginForm()
    {
        
        return view('doctor.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('doctor');
    }

    protected function attemptLogin(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'email'       => 'required|string|email',
            'password'    =>  'required|string|min:8',

        ]);
		
        if($validator->fails()) {
           return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
        
        // dd(122);
        if(Auth::guard('doctor')->attempt($request->only('email','password'),$request->filled('remember'))){
            return redirect()
                ->route('doctor.dashboard')
                ->with('status','You are Logged in as Doctor!');
        }
        return redirect()->back()
        ->with('error','Wrong Credentials!');
    }

    public function logout(Request $request)
    {
        $this->guard('doctor')->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('doctor/login');
    }
}

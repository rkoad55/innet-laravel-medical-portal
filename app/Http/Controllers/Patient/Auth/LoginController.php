<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\PatientModel as Patient;
use Auth;
use Validator;
use App\Events\PatientVerification;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    protected $redirectTo = 'patient/dashboard';

    public function __construct()
    {
        $this->middleware('guest:patient')->except('logout');
    }

    public function showLoginForm()
    {
        
        return view('patient.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('patient');
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
        if(Auth::guard('patient')->attempt($request->only('email','password'),$request->filled('remember'))){
            return redirect()
                ->route('patient.dashboard')
                ->with('status','You are Logged in as Patient!');
                exit;
        }
        return redirect()->back()
        ->with('error','Wrong Credentials!');
    }

    public function logout(Request $request)
    {
        $this->guard('patient')->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('patient/login');
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Model\SpecilitizationModel as Specilitization;
use App\Model\DoctorModel as Doctor;
// use App\Model\BrandModel as Brand;
use App\Events\DoctorVerification;
use Auth;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/doctor/dashboard';

    public function __construct()
    {
        $this->middleware('guest:doctor');
    }

    protected function guard()
    {
        return Auth::guard('doctor');
    }

    protected function validator(array $data)
    {
        

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:doctors'],
            'password' => ['required', 'string', 'between:8,255', 'confirmed'],
            'specilitization' => ['required', 'array'],
        ]);
    }

    protected function create(array $data)
    {

        
        
        return Doctor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'hash' => \Str::random(40),
            'specilitization_id' => implode(',',$data['specilitization']),
            ]);

            /* if(Auth::guard('doctor')->attempt($doctor->only('email','password'))){
                return redirect()
                    ->intended(route('doctor.dashboard'))
                    ->with('status','You are Logged in as Doctor!');
            } */
            // dd($data);
    }


    public function showRegistrationForm()
    {
        $specilitization = Specilitization::all()->toArray();
        // dd($Specilitization);
        return view('doctor.auth.register', compact('specilitization'))->with('form_msg', 'Please register and wait for approval call');
    }
}

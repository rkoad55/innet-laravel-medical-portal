<?php

namespace App\Http\Controllers\Patient\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Model\SpecilitizationModel as Specilitization;
use App\Model\PatientModel as Patient;
// use App\Model\BrandModel as Brand;
use App\Events\PatientVerificationEvent;
use Auth;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/patient/dashboard';

    public function __construct()
    {
        $this->middleware('guest:patient');
    }

    protected function guard()
    {
        return Auth::guard('patient');
    }

    protected function validator(array $data)
    {
        // dd($data);
        

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'password' => ['required', 'string', 'between:8,255', 'confirmed'],
            // 'specilitization' => ['required', 'array'],
        ]);
    }

    protected function create(array $data)
    {
        

        
        
        return Patient::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'hash' => \Str::random(40),
            'depart_id' => implode(',',$data['depart']),
            ]);

    }


    public function showRegistrationForm()
    {
        $depart = Specilitization::all()->toArray();
        // dd($Specilitization);
        return view('patient.auth.register', compact('depart'))->with('form_msg', '');
    }

}

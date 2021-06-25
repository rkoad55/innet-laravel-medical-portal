<?php

namespace App\Http\Controllers\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DoctorModel as Doctor;
use App\Model\PatientModel as Patient;
use Auth;
use Hash;
use Carbon\Carbon;
// use App\Events\DoctorVerification;
class PatientverificationController extends Controller
{
    // public $setting;
    public function __construct(Request $request)
    {
        // $this->middleware('auth:patient');   
        
    }

    public function index(Request $request)
    { 
        $token = explode("-", $request->token);
        $hash_token = $token[0];
        $id = $token[4];
        $patient = Patient::where('hash',$hash_token)->where('id',$id)->get();
        // dd($patient);
        if(count($patient) && (is_null($patient[0]->email_verified_at))){
            $updatePatient= Patient::find($id);
            $updatePatient->email_verified_at = Carbon::now();
            $updatePatient->save();
            return redirect('patient/dashboard')->with('msg','Congratulation! your account is verified!');
        }
        Auth::guard('patient')->logout();
        return redirect('patient/login')->route();


        
        // dd($token, $patient, Carbon::now());
        // return view('patient.dashboard');

    }

}
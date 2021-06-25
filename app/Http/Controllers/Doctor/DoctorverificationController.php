<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DoctorModel as Doctor;
use Auth;
use Hash;
use Carbon\Carbon;
// use App\Events\DoctorVerification;
class DoctorverificationController extends Controller
{
    // public $setting;
    public function __construct(Request $request)
    {
        // $this->middleware('auth:doctor');   
        
    }

    public function index(Request $request)
    { 
        $token = explode("-", $request->token);
        $hash_token = $token[0];
        $id = $token[4];
        $doctor = Doctor::where('hash',$hash_token)->where('id',$id)->get();
        // dd($doctor);
        if(count($doctor) && (is_null($doctor[0]->email_verified_at))){
            $updateDoctor = Doctor::find($id);
            $updateDoctor->email_verified_at = Carbon::now();
            $updateDoctor->save();
            return redirect('doctor/dashboard')->with('msg','Congratulation!');
        }
        Auth::guard('doctor')->logout();
        return redirect('doctor/login');


        
        // dd($token, $doctor, Carbon::now());
        // return view('doctor.dashboard');

    }

}
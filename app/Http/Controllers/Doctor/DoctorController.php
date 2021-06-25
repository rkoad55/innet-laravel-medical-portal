<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CentralController;
use Illuminate\Http\Request;
use App\Model\DoctorModel as Doctor;
use App\Model\CountryAndStatesModel as CountryAndStates;
use App\Model\SpecilitizationModel as Specilitization;
use App\Model\DoctorAvalibilityModel as DoctorAvalibility;
use Auth;
use Hash;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;
use File;
// use App\Events\DoctorVerification;
class DoctorController extends Controller
{
    // public $setting;
    public function __construct(Request $request, CentralController $CentralController)
    {
        $this->middleware('auth:doctor');
        $this->CentralController = new CentralController();   
        
    }

    public function index()
    { 
        $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        $specilitization = Specilitization::where('status', 1)->get()->toArray();
        return view('doctor.dashboard', compact('country', 'specilitization'));

    }

    public function submitDoctorInformation(Request $request)
    { 
        $doctor = Doctor::find(Auth::guard('doctor')->user()->id);
        if ($request->has('name')) {
            $doctor->name = ucfirst($request->name);
        }
        if ($request->has('middle_name')) {
            $doctor->middle_name = ucfirst(substr($request->middle_name,0,1));
        }
        if ($request->has('last_name')) {
            $doctor->last_name = ucfirst($request->last_name);
        }
        if ($request->has('email')) {
            $doctor->email = $request->email;
        }
        if ($request->has('country')) {
            $doctor->country = $request->country;
        }
        if ($request->has('state')) {
            $doctor->state = $request->state;
        }
        if ($request->has('city')) {
            $doctor->city = $request->city;
        }
        if ($request->has('address')) {
            $doctor->address = ucwords($request->address);
        }
        if ($request->has('experince')) {
            $doctor->experince = $request->experince;
        }
        if ($request->has('specialization_id')) {
            $doctor->specialization_id = implode(",",$request->specialization_id);
            // $doctor->specialization = $request->specialization;
        }
        if ($request->has('current_job')) {
            $doctor->current_job = $request->current_job;
        }
        if ($request->has('image')) {
            $doctor->current_job = $request->current_job;
        }
        if ($request->has('note')) {
            $doctor->note = ucfirst($request->note);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
			$st_random = str_random(10);
			$filename = $file->getClientOriginalName();
            $filename = explode(".",$filename);
            $ext = $filename[1];
			$filename = $filename[0].$st_random.".".$filename[1];
			// $thumbnail = $filename[0].$st_random."-thumbs.".$filename[1];
            Storage::disk('Backend')->put('/doctor/'.$filename, File::get($file));
            $doctor->image = '/images/doctor/'.$filename;
            Image::make(public_path($doctor->image))->resize(128,128)->save(public_path('/thumbs/'.$doctor->image));


        }
        if ($request->has('contact_no')) {
            $doctor->contact_no = $request->contact_no;
        }
        if($doctor->save()){
            return 1;
        }

    }

    public function DoctorProfile(Request $request){
        $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        $specilitization = Specilitization::where('status', 1)->get()->toArray();
        return view('doctor.profile', compact('country', 'specilitization'));


    }

    public function submitAvalibility(Request $request)
    {
        
        $doctor_avalibility = DoctorAvalibility::updateOrCreate(['doctor_id' => Auth::guard('doctor')->user()->id]);
        // dd($request->all());    
        /* if(is_null($doctor_avalibility))
        {
            $doctor_avalibility = new DoctorAvalibility();
            
        } */
        
        $doctor_avalibility->doctor_id = Auth::guard('doctor')->user()->id;
        if (($request->has('monday') && $request->monday == 'on') && strlen($request->monday_start_at) && strlen($request->monday_end_at))
        {
            $doctor_avalibility->monday = 1;
            $doctor_avalibility->monday_start_at = $request->monday_start_at;
            $doctor_avalibility->monday_end_at = $request->monday_end_at;
        }else{
            $doctor_avalibility->monday = null;
            $doctor_avalibility->monday_start_at = null;
            $doctor_avalibility->monday_end_at = null;

        }
        if (($request->has('tuesday') && $request->tuesday == 'on') && strlen($request->tuesday_start_at) && strlen($request->tuesday_end_at))
        {
            $doctor_avalibility->tuesday = 1;
            $doctor_avalibility->tuesday_start_at = $request->tuesday_start_at;
            $doctor_avalibility->tuesday_end_at = $request->tuesday_end_at;
        }else{
            $doctor_avalibility->tuesday = null;
            $doctor_avalibility->tuesday_start_at = null;
            $doctor_avalibility->tuesday_end_at = null;
        }
        if (($request->has('wednesday') && $request->wednesday == 'on') && strlen($request->wednesday_start_at) && strlen($request->wednesday_end_at))
        {
            $doctor_avalibility->wednesday = 1;
            $doctor_avalibility->wednesday_start_at = $request->wednesday_start_at;
            $doctor_avalibility->wednesday_end_at = $request->wednesday_end_at;
        }else{
            $doctor_avalibility->wednesday = null;
            $doctor_avalibility->wednesday_start_at = null;
            $doctor_avalibility->wednesday_end_at = null;

        }
        if (($request->has('thursday') && $request->thursday == 'on') && strlen($request->thursday_start_at) && strlen($request->thursday_end_at))
        {
            $doctor_avalibility->thursday = 1;
            $doctor_avalibility->thursday_start_at = $request->thursday_start_at;
            $doctor_avalibility->thursday_end_at = $request->thursday_end_at;
        }else{
            $doctor_avalibility->thursday = null;
            $doctor_avalibility->thursday_start_at = null;
            $doctor_avalibility->thursday_end_at = null;

        }
        if (($request->has('friday') && $request->friday == 'on') && strlen($request->friday_start_at) && strlen($request->friday_end_at))
        {
            $doctor_avalibility->friday = 1;
            $doctor_avalibility->friday_start_at = $request->friday_start_at;
            $doctor_avalibility->friday_end_at = $request->friday_end_at;
        }else{
            $doctor_avalibility->friday = null;
            $doctor_avalibility->friday_start_at = null;
            $doctor_avalibility->friday_end_at = null;

        }
        if (($request->has('saturday') && $request->saturday == 'on') && strlen($request->saturday_start_at) && strlen($request->saturday_end_at))
        {
            $doctor_avalibility->saturday = 1;
            $doctor_avalibility->saturday_start_at = $request->saturday_start_at;
            $doctor_avalibility->saturday_end_at = $request->saturday_end_at;
        }else{
            $doctor_avalibility->saturday = null;
            $doctor_avalibility->saturday_start_at = null;
            $doctor_avalibility->saturday_end_at = null;

        }
        if (($request->has('sunday') && $request->sunday == 'on') && strlen($request->sunday_start_at) && strlen($request->sunday_end_at))
        {
            $doctor_avalibility->sunday = 1;
            $doctor_avalibility->sunday_start_at = $request->sunday_start_at;
            $doctor_avalibility->sunday_end_at = $request->sunday_end_at;
        }else{
            $doctor_avalibility->sunday = null;
            $doctor_avalibility->sunday_start_at = null;
            $doctor_avalibility->sunday_end_at = null;

        }
        $doctor_avalibility->status = 1;
        if($doctor_avalibility->save())
        {
            return 1;
        }
        return 2;
        


    }

    public function DoctorAppointment(Request $request){
        $page_title = "Appointments";
        return view('doctor.appointment', compact('page_title'));


    }


}
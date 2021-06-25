<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CentralController;
use Illuminate\Http\Request;
use App\Model\AdminModel as Admin;
use App\Model\DoctorModel as Doctor;
use App\Model\PatientModel as Patient;
use App\Model\CountryAndStatesModel as CountryAndStates;
use App\Model\SpecilitizationModel as Specilitization;
use App\Model\adminAvalibilityModel as adminAvalibility;
use App\Model\AppointmentModel as Appointment;
use App\Model\RefundModel as Refund;
use App\Http\Controllers\PaymentMethodController;
use Auth;
use Hash;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;
use File;
// use App\Events\adminVerification;
class AdminController extends Controller
{
    // public $setting;
    protected $PaymentMethodController;
    public function __construct(Request $request, CentralController $CentralController, PaymentMethodController $PaymentMethodController)
    {
        $this->middleware('auth:admin');
        $this->PaymentMethodController = new PaymentMethodController(); 
        $this->CentralController = new CentralController();   
        
    }

    public function index()
    { 
        $doctor_count = Doctor::where('status', 1)->count();
        $patient_count = Patient::where('status', 1)->count();
        // $specilitization = Specilitization::where('status', 1)->get()->toArray(); 
        return view('admin.dashboard', compact('doctor_count', 'patient_count'));

    }

    public function getProfile(Request $request){

        $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        $page_title = "Profile";
        return view('admin.profile', compact('country', 'page_title'));

    }
    public function setDoctorStatus(Request $request){
        // dd($request->all());
        $doctor = Doctor::find($request->id);
        $doctor->status = $request->status;
        $doctor->updated_at = date('Y-m-d H:i:s');
        if($doctor->save()){
            echo 1;
        }else{
            echo 2;
        }
        exit;
    }

    public function setPatientStatus(Request $request){
        // dd($request->all());
        $patient = Patient::find($request->id);
        $patient->status = $request->status;
        $patient->updated_at = date('Y-m-d H:i:s');
        if($patient->save()){
            echo 1;
        }else{
            echo 2;
        }
        exit;
    }

    public function submitAdminInformation(Request $request)
    { 
        // dd($request->all());
        $admin = admin::find(Auth::guard('admin')->user()->id);
        if ($request->has('name')) {
            $admin->name = ucfirst($request->name);
        }
        if ($request->has('middle_name')) {
            $admin->middle_name = ucfirst(substr($request->middle_name,0,1));
        }
        if ($request->has('last_name')) {
            $admin->last_name = ucfirst($request->last_name);
        }
        if ($request->has('country')) {
            $admin->country = $request->country;
        }
        if ($request->has('state')) {
            $admin->state = $request->state;
        }
        if ($request->has('address')) {
            $admin->address = ucwords($request->address);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
			$st_random = str_random(10);
			$filename = $file->getClientOriginalName();
            $filename = explode(".",$filename);
            $ext = $filename[1];
			$filename = $filename[0].$st_random.".".$filename[1];
			// $thumbnail = $filename[0].$st_random."-thumbs.".$filename[1];
            Storage::disk('Backend')->put('/admin/'.$filename, File::get($file));
            $admin->image = '/images/admin/'.$filename;
            Image::make(public_path($admin->image))->resize(128,128)->save(public_path('/thumbs/'.$admin->image));


        }
        if ($request->has('contact_no')) {
            $admin->contact_no = $request->contact_no;
        }
        if($admin->save()){
            return 1;
        }

    }

    public function passwordreset(Request $request){
        dd($request->all());
        
    }
    public function adminProfile(Request $request){
        $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        $specilitization = Specilitization::where('status', 1)->get()->toArray();
        return view('admin.profile', compact('country', 'specilitization'));


    }

    public function submitAvalibility(Request $request)
    {
        
        $admin_avalibility = adminAvalibility::updateOrCreate(['admin_id' => Auth::guard('admin')->user()->id]);
        // dd($request->all());    
        /* if(is_null($admin_avalibility))
        {
            $admin_avalibility = new adminAvalibility();
            
        } */
        
        $admin_avalibility->admin_id = Auth::guard('admin')->user()->id;
        if (($request->has('monday') && $request->monday == 'on') && strlen($request->monday_start_at) && strlen($request->monday_end_at))
        {
            $admin_avalibility->monday = 1;
            $admin_avalibility->monday_start_at = $request->monday_start_at;
            $admin_avalibility->monday_end_at = $request->monday_end_at;
        }else{
            $admin_avalibility->monday = null;
            $admin_avalibility->monday_start_at = null;
            $admin_avalibility->monday_end_at = null;

        }
        if (($request->has('tuesday') && $request->tuesday == 'on') && strlen($request->tuesday_start_at) && strlen($request->tuesday_end_at))
        {
            $admin_avalibility->tuesday = 1;
            $admin_avalibility->tuesday_start_at = $request->tuesday_start_at;
            $admin_avalibility->tuesday_end_at = $request->tuesday_end_at;
        }else{
            $admin_avalibility->tuesday = null;
            $admin_avalibility->tuesday_start_at = null;
            $admin_avalibility->tuesday_end_at = null;
        }
        if (($request->has('wednesday') && $request->wednesday == 'on') && strlen($request->wednesday_start_at) && strlen($request->wednesday_end_at))
        {
            $admin_avalibility->wednesday = 1;
            $admin_avalibility->wednesday_start_at = $request->wednesday_start_at;
            $admin_avalibility->wednesday_end_at = $request->wednesday_end_at;
        }else{
            $admin_avalibility->wednesday = null;
            $admin_avalibility->wednesday_start_at = null;
            $admin_avalibility->wednesday_end_at = null;

        }
        if (($request->has('thursday') && $request->thursday == 'on') && strlen($request->thursday_start_at) && strlen($request->thursday_end_at))
        {
            $admin_avalibility->thursday = 1;
            $admin_avalibility->thursday_start_at = $request->thursday_start_at;
            $admin_avalibility->thursday_end_at = $request->thursday_end_at;
        }else{
            $admin_avalibility->thursday = null;
            $admin_avalibility->thursday_start_at = null;
            $admin_avalibility->thursday_end_at = null;

        }
        if (($request->has('friday') && $request->friday == 'on') && strlen($request->friday_start_at) && strlen($request->friday_end_at))
        {
            $admin_avalibility->friday = 1;
            $admin_avalibility->friday_start_at = $request->friday_start_at;
            $admin_avalibility->friday_end_at = $request->friday_end_at;
        }else{
            $admin_avalibility->friday = null;
            $admin_avalibility->friday_start_at = null;
            $admin_avalibility->friday_end_at = null;

        }
        if (($request->has('saturday') && $request->saturday == 'on') && strlen($request->saturday_start_at) && strlen($request->saturday_end_at))
        {
            $admin_avalibility->saturday = 1;
            $admin_avalibility->saturday_start_at = $request->saturday_start_at;
            $admin_avalibility->saturday_end_at = $request->saturday_end_at;
        }else{
            $admin_avalibility->saturday = null;
            $admin_avalibility->saturday_start_at = null;
            $admin_avalibility->saturday_end_at = null;

        }
        if (($request->has('sunday') && $request->sunday == 'on') && strlen($request->sunday_start_at) && strlen($request->sunday_end_at))
        {
            $admin_avalibility->sunday = 1;
            $admin_avalibility->sunday_start_at = $request->sunday_start_at;
            $admin_avalibility->sunday_end_at = $request->sunday_end_at;
        }else{
            $admin_avalibility->sunday = null;
            $admin_avalibility->sunday_start_at = null;
            $admin_avalibility->sunday_end_at = null;

        }
        $admin_avalibility->status = 1;
        if($admin_avalibility->save())
        {
            return 1;
        }
        return 2;
        


    }

    public function adminAppointment(Request $request){
        $date = isset($request->date)?$request->date:"";
        // dd($date);
        $page_title = "Appointments";
        // $appointment = "Appointments";
        return view('admin.appointment', compact('page_title', 'appointment', 'date'));


    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $department = Department::find($request->id);
        $department->status = $request->status;
        $department->updated_at = date('Y-m-d H:i:s');
        if($department->save()){
            echo 1;
        }else{
            echo 2;
        }
        exit;
    }
    
    public function postRefund(Request $request){
        $amount = $request->amount;
        $refund_amount = $request->refund_amount;
        // $refund_amount
        if($amount == $refund_amount){
            $refund_amount = $amount;
        }
        $this->paymentRefund($request->id, $refund_amount, $amount);
        $appointment = Appointment::where('transaction_id', $request->id)->update(['refund_amount' => $refund_amount, 'updated_by' => Auth::guard('admin')->user()->name]);
        // $id = $appointment[0]['id'];
        return $refund_amount;

    }

    protected function paymentRefund($previous_transaction_id, $refund_amount, $amount){

       /*  $amount = "50.00"; 
        $cc_number = "4111111111111111"; 
        $cvv_number = "1010";  */

        $this->PaymentMethodController->setLogin("6457Thfj624V5r7WUwc5v6a68Zsd6YEm");
        $result = $this->PaymentMethodController->doRefund($previous_transaction_id, $refund_amount);
        
        
        $response_id = explode('=', $result[0]);
        $response_text = explode('=', $result[1]);
        $response_transaction_id = explode('=', $result[3]);
        $response_code = explode('=', $result[8]);
        
        $id = $response_id[1];
        $text = $response_text[1];
        $code = $response_code[1];
        $transaction_id = $response_transaction_id[1];
        $response = array();
        $response['id'] = $id;
        $response['text'] = $text;
        $response['transaction_id'] = $transaction_id;
        $response['code'] = $code;
        dd($result);
        if($response['id'] == 1 && $response['text'] == 'SUCCESS' && $response['code'] == 100){
            $this->paymentRefundAddToDB($previous_transaction_id, $transaction_id, $refund_amount, $amount);
        }

        return $response;
    }

    protected function paymentRefundAddToDB($previous_transaction_id, $transaction_id, $refund_amount, $amount){
        $paymentRefundAddToDB = new Refund();
        $paymentRefundAddToDB->added_by = Auth::guard('admin')->user()->id;
        $paymentRefundAddToDB->transaction_id = $previous_transaction_id;
        $paymentRefundAddToDB->refund_transaction_id = $transaction_id;
        $paymentRefundAddToDB->refund_amount = $refund_amount;
        $paymentRefundAddToDB->amount = $amount;
        $paymentRefundAddToDB->transaction_id = $transaction_id;
        if($paymentRefundAddToDB->save()){
            return 1;
        }

    }

}
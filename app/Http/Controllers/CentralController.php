<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DoctorModel as Doctor;
use App\Model\PatientModel as Patient;
use App\Model\CountryAndStatesModel as CountryAndStates;
use App\Model\SpecilitizationModel as Specilitization;
use App\Model\DoctorAvalibilityModel as DoctorAvalibility;
use App\Model\AppointmentModel as Appointment;
use App\Model\PatientPastHistoryModel as PatientPastHistory;
use App\Model\PatientMentalHealthModel as PatientMentalHealth;
use App\Model\CardDetailModel as CardDetail;
use Auth;
use Hash;
use View;

class CentralController extends Controller
{
    /* public function __construct(Request $request)
    {
        // $this->middleware('auth:doctor');
        // $CentralController = new CentralController(); 
        // View::share ( 'CentralController', $CentralController );  
        
    } */

    public function checkDateTime($date1 , $date2){
        // Declare and define two dates 
        $date1 = strtotime($date1);  
        $date2 = strtotime($date2);  
        
        // Formulate the Difference between two dates 
        $diff = abs($date2 - $date1);  
        
        
        // To get the year divide the resultant date into 
        // total seconds in a year (365*60*60*24) 
        $years = floor($diff / (365*60*60*24));  
        
        
        // To get the month, subtract it with years and 
        // divide the resultant date into 
        // total seconds in a month (30*60*60*24) 
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
  
  
        // To get the day, subtract it with years and  
        // months and divide the resultant date into 
        // total seconds in a days (60*60*24) 
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
  
  
        // To get the hour, subtract it with years,  
        // months & seconds and divide the resultant 
        // date into total seconds in a hours (60*60) 
        $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
  
  
        // To get the minutes, subtract it with years, 
        // months, seconds and hours and divide the  
        // resultant date into total seconds i.e. 60 
        return $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

        // To get the minutes, subtract it with years, 
        // months, seconds, hours and minutes  
        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

    }

    public function getState(Request $request)
    { 
        return $state = CountryAndStates::select('id', 'title')->where('status', 1)->where('child_id', $request->id)->get()->toArray();
        // dd($country);

    }
    public function getCity(Request $request)
    { 
        // dd($request->all());
        return $city = CountryAndStates::select('id', 'title')->where('status', 1)->where('child_id', $request->id)->get()->toArray();

    }

    public function getCountryById($id)
    { 
        // dd($request->all());
        return $country = CountryAndStates::select('id', 'title')->where('status', 1)->where('id', $id)->get()->toArray();

    }

    public function getStateById($id)
    { 
        return $state = CountryAndStates::select('id', 'title')->where('status', 1)->where('child_id', $id)->get()->toArray();
        // dd($state);

    }
    public function getCityById($id)
    { 
        // dd($request->all());
        return $state = CountryAndStates::select('id', 'title')->where('status', 1)->where('child_id', $id)->get()->toArray();

    }

    public function getSpecializationById($id)
    { 
        // dd($request->all());
        return $state = Specilitization::select('id', 'title')->where('status', 1)->whereRaw('FIND_IN_SET(id,"'.$id.'")')->get()->toArray();

    }

    public function getDoctorAvalibilityById($id)
    { 
        // dd($request->all());getDoctorAvalibilityById
        $doctor_avalibility = DoctorAvalibility::where('status', 1)->where('doctor_id', $id)->get()->toArray();
        // if(count($doctor_avalibility){}
        if(empty($doctor_avalibility)){
            return $doctor_avalibility[0] = array();
        }
        return $doctor_avalibility[0];

    }

    public function getAllDoctors()
    { 
        return $doctor = Doctor::whereNotNull('email_verified_at')->get();
        // dd($doctor);
        // return $doctor;

    }

    public function getAllPatients()
    { 
        return $patient = Patient::whereNotNull('email_verified_at')->get();
        // dd($doctor);
        // return $doctor;

    }

    public function getDoctorById($id)
    { 
        $doctor = Doctor::where('id',$id)->where('status', 1)->whereNotNull('email_verified_at')->get();
        if(empty($doctor)){
            return $doctor[0] = array();
        }
        return $doctor[0];
        
    }

    public function getPatientById($id)
    { 
        $patient = Patient::where('id',$id)->where('status', 1)->whereNotNull('email_verified_at')->get();
        if($patient->isEmpty()){
            return $patient[0] = array();
        }
        // dd($patient);
        return $patient[0];
        
    }

    public function getAllAppointment($date = null){
        // dd($date);whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        if(strlen($date) && ($date == 'month')){
            return $appointment = Appointment::whereMonth('created_at', \Carbon\Carbon::now()->month)->where('status', '1')->orderBy('appointment_id', 'DESC')->with('payment')->get();
        }elseif(strlen($date) && ($date == 'year')){
            return $appointment = Appointment::whereYear('created_at', \Carbon\Carbon::now()->year)->where('status', '1')->orderBy('appointment_id', 'DESC')->with('payment')->get();
        }elseif(strlen($date) && ($date == 'today')){
            return $appointment = Appointment::whereDate('created_at', \Carbon\Carbon::today())->where('status', '1')->orderBy('appointment_id', 'DESC')->with('payment')->get();

        }elseif(strlen($date) && ($date == 'week')){
            \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::MONDAY);
            \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SUNDAY);
            return $appointment = Appointment::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->where('status', '1')->orderBy('appointment_id', 'DESC')->with('payment')->get();

        }else{
            return $appointment = Appointment::where('status', '1')->orderBy('appointment_id', 'DESC')->with('payment')->get();
        }

    }

    public function getDoctorAppointmentCounter($id, $date = null){
        // dd($date);whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        if(strlen($date) && ($date == 'month')){
            return $appointment = Appointment::whereMonth('created_at', \Carbon\Carbon::now()->month)->where('doctor_id',$id)->where('status', '1')->where('refund', '1')->count();
        }elseif(strlen($date) && ($date == 'year')){
            return $appointment = Appointment::whereYear('created_at', \Carbon\Carbon::now()->year)->where('doctor_id',$id)->where('status', '1')->where('refund', '1')->count();
        }elseif(strlen($date) && ($date == 'today')){
            return $appointment = Appointment::whereDate('created_at', \Carbon\Carbon::today())->where('doctor_id',$id)->where('status', '1')->where('refund', '1')->count();

        }elseif(strlen($date) && ($date == 'week')){
            \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::MONDAY);
            \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SUNDAY);
            return $appointment = Appointment::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->where('doctor_id',$id)->where('status', '1')->where('refund', '1')->count();

        }elseif(strlen($date) && ($date == 'refund')){
            return $appointment = Appointment::where('doctor_id',$id)->where('status', '1')->where('refund', '0')->count();

        }else{
            return $appointment = Appointment::where('doctor_id',$id)->where('status', '1')->where('refund', '1')->count();
        }

    }

    public function getDoctorAppointment($id){
        return $appointment = Appointment::where('doctor_id', $id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->where('refund', '1')->where('status', '1')->get()->toArray();

    }

    public function getPatientAppointment($id){
        return $appointment = Appointment::where('patient_id', $id)->whereDate('created_at', \Carbon\Carbon::today())->where('refund', '1')->where('status', '1')->get()->toArray();
    }
    
    public function getAppointmentBetweenDoctorAndPatient($patient_id, $doctor_id){
        return $appointment = Appointment::where('doctor_id', $doctor_id)->where('patient_id', $patient_id)->whereDate('created_at', \Carbon\Carbon::today())->where('status', '1')->get()->toArray();
    }

    public function getPatientMentalHealth($id){
        return $patient_mental_health = PatientMentalHealth::where('patient_id', $id)->get();
    }
    public function getPatientPastHistory($id){
        return $patient_mental_health = PatientPastHistory::where('patient_id', $id)->get();
    }
    public function getPatientCardDetail($id){
        $patient_card_detail = CardDetail::where('patient_id', $id)->get();
        if(empty($patient_card_detail)){
            return $patient_card_detail[0] = array();
        }
        return $patient_card_detail[0];
    }

    

}
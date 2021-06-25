<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\CentralController;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\Patient\PaymentMethodController;
use App\Http\Controllers\PaymentMethodController;
use App\Model\AppointmentModel as Appointment;
use App\Model\CardDetailModel as CardDetail;
use App\Model\CountryAndStatesModel as CountryAndStates;
use App\Model\PatientMentalHealthModel as PatientMentalHealth;
use App\Model\PatientModel as Patient;
use App\Model\PaymentModel as Payment;
use App\Model\SpecilitizationModel as Specilitization;
use Auth;
use coviu\Api\Coviu;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

// use App\Events\DoctorVerification;
class PatientController extends Controller
{
    protected $CentralController;
    protected $coviu;
    protected $PaymentMethodController;
    public function __construct(Request $request, CentralController $CentralController, PaymentMethodController $PaymentMethodController)
    {
        // dd(123);
        $this->middleware('auth:patient');
        $this->CentralController = new CentralController();
        $this->PaymentMethodController = new PaymentMethodController();
        $this->coviu = new Coviu('2326f7af-79dc-4eca-a265-6117bcf82bdd', 'e06da7f560e854781ed8');

    }

    public function index()
    {
        $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        $specilitization = Specilitization::where('status', 1)->get()->toArray();
        return view('patient.dashboard', compact('country', 'specilitization'));

    }

    public function AddPaymentDetail(Request $request)
    {

        $card_detail = CardDetail::updateOrCreate(['patient_id' => Auth::guard('patient')->user()->id]);

        $card_detail->patient_id = Auth::guard('patient')->user()->id;

        if ($request->has('cc_number')) {
            $card_detail->cc_number = $request->cc_number;
        }
        if ($request->has('cvv_number')) {
            $card_detail->cvv_number = $request->cvv_number;
        }
        if ($request->has('month') && $request->has('year')) {
            $card_detail->valid_date = $request->month . '/' . $request->year;
        }
        $card_detail->save();
        return 1;
    }
    public function submitPatientPastHistory(Request $request)
    {

    }
    public function submitPatientMentalhealth(Request $request)
    {
        //dd($request->all());
        $mental_health = PatientMentalHealth::updateOrCreate(['patient_id' => Auth::guard('patient')->user()->id]);
        $mental_health->patient_id = Auth::guard('patient')->user()->id;
        if ($request->has('primary_care_physician')) {
            $mental_health->primary_care_physician = $request->primary_care_physician;
        }

        if ($request->has('current_therapist')) {
            $mental_health->current_therapist = $request->current_therapist;
        }

        if ($request->has('therapist_phone')) {
            $mental_health->therapist_phone = $request->therapist_phone;
        }

        if ($request->has('permission') && $request->permission == 'on') {
            $mental_health->permission = 1;
        }

        if ($request->has('problem')) {
            $mental_health->problem = $request->problem;
        }

        if ($request->has('treatment_goal')) {
            $mental_health->treatment_goal = $request->treatment_goal;
        }

        if ($request->has('symtoms')) {
            $mental_health->symtoms = implode(",", $request->symtoms);
        }

        if ($request->has('life_feeling')) {
            $mental_health->life_feeling = $request->life_feeling;
        }
        if ($request->has('currently_life_feeling')) {
            $mental_health->currently_life_feeling = $request->currently_life_feeling;
        }

        if ($request->has('thoughts')) {
            $mental_health->thoughts = $request->thoughts;
        }

        if ($request->has('last_time_dying_thoughts')) {
            $mental_health->last_time_dying_thoughts = $request->last_time_dying_thoughts;
        }
        if ($request->has('recent_feel')) {
            $mental_health->recent_feel = $request->recent_feel;
        }
        if ($request->has('feel_scale')) {
            if ($request->feel_scale > 10) {
                $request->feel_scale = 10;
            }
            $mental_health->feel_scale = $request->feel_scale;
        }

        if ($request->has('make_better')) {
            $mental_health->make_better = $request->make_better;
        }

        if ($request->has('kill_yourself')) {
            $mental_health->kill_yourself = $request->kill_yourself;
        }
        if ($request->has('readily_available')) {
            $mental_health->readily_available = $request->readily_available;
        }
        if ($request->has('planned_time')) {
            $mental_health->planned_time = $request->planned_time;
        }
        if ($request->has('stop_killing')) {
            $mental_health->stop_killing = $request->stop_killing;
        }
        if ($request->has('hopeless')) {
            $mental_health->hopeless = $request->hopeless;
        }
        if ($request->has('tried_kill_or_harm')) {
            $mental_health->tried_kill_or_harm = $request->tried_kill_or_harm;
        }
        if ($request->has('access_gun')) {
            $mental_health->access_gun = $request->access_gun;
        }
        if ($request->has('access_gun_explain') && $request->has('access_gun')) {
            $mental_health->access_gun_explain = $request->access_gun_explain;
        }
        $mental_health->save();

        return 1;

    }

    public function submitPatientInformation(Request $request)
    {
        // dd($request->all());
        $patient = Patient::find(Auth::guard('patient')->user()->id);

        if (!strlen($patient->name) && $request->has('name')) {
            $patient->name = ucwords($request->name);
        }
        if (!strlen($patient->middle_name) && $request->has('middle_name')) {
            $patient->middle_name = ucfirst(substr($request->middle_name, 0, 1));
        }

        if (!strlen($patient->last_name) && $request->has('last_name')) {
            $patient->last_name = ucwords($request->last_name);
        }

        if (!strlen($patient->email) && $request->has('email')) {
            $patient->email = $request->email;
        }
        if ($request->has('country')) {
            $patient->country = $request->country;
        }
        if ($request->has('state')) {
            $patient->state = $request->state;
        }
        if ($request->has('address')) {
            $patient->address = $request->address;
        }
        if ($request->has('dob')) {
            $patient->dob = $newDate = date("Y-m-d", strtotime($request->dob));
        }
        if ($request->has('depart_id')) {
            $patient->depart_id = implode(",", $request->depart_id);
            // $patient->specialization = $request->specialization;
        }
        // if ($request->has('current_job')) {
        //     $patient->current_job = $request->current_job;
        // }
        if ($request->has('image')) {
            $patient->current_job = $request->current_job;
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $st_random = str_random(10);
            $filename = $file->getClientOriginalName();
            $filename = explode(".", $filename);
            $ext = $filename[1];
            $filename = $filename[0] . $st_random . "." . $filename[1];
            // $thumbnail = $filename[0].$st_random."-thumbs.".$filename[1];
            Storage::disk('Backend')->put('/patient/' . $filename, File::get($file));
            $patient->image = '/images/patient/' . $filename;
            Image::make(public_path($patient->image))->resize(128, 128)->save(public_path('/thumbs/' . $patient->image));

        }
        if ($request->has('contact_no')) {
            $patient->contact_no = $request->contact_no;
        }
        if ($patient->save()) {
            return 1;
        }

    }

    public function PatientProfile(Request $request)
    {
        $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        $specilitization = Specilitization::where('status', 1)->get()->toArray();
        $page_title = "Profile";
        return view('patient.profile', compact('country', 'specilitization', 'page_title'));

    }

    public function PatientAppointment(Request $request)
    {
        // $country = CountryAndStates::where('status', 1)->whereNull('child_id')->with('city')->get()->toArray();
        // $specilitization = Specilitization::where('status', 1)->get()->toArray();
        $page_title = "Request For Appointment";
        return view('patient.appointment', compact('page_title'));

    }

    public function getDoctors(Request $request)
    {
        $page_title = "doctor List";
        return view('patient.appointment.list', compact('page_title'));

    }

    public function appointmentBooking(Request $request)
    {
        $doctor = $this->CentralController->getDoctorById($request->doctor_id);
        $doctor_name = isset($doctor->name) ? $doctor->name : '';
        $page_title = "Book Appointment with Dr. " . ucwords($doctor_name);
        return view('patient.appointment.booking', compact('page_title', 'doctor'));

    }

    public function appointmentBookingSubmit(Request $request)
    {
        // dd($request->all());
        $appointment_time = explode(" - ", $request->appointment_time);
        //date_default_timezone_set("Asia/Karachi");
        // $timezone = new \DateTimeZone('Asia/Karachi');
        // $date_now = new \DateTime();
        // $date2  = \DateTime::createFromFormat('m/d/Y H:i A', $appointment_time[0], $timezone);
        // $date2    = new \DateTime($appointment_time[0]);
        // dd($appointment_time);
        $error = array();
        /* if ($date_now > $date2) {
        $error['code'] = 2;
        $error['msg'] = "Start Date and time Must be Greater than Current Date and Time";
        return $error;
        exit;
        } */

        //$minustes = $this->checkDateTime($appointment_time[0], $appointment_time[1]);
        // dd($appointment_time, $date2, $date_now, $minustes);

        /* if ($minustes < 10) {
        $error['code'] = 2;
        $error['msg'] = "minmum 10 mins Required to Schedule the session";
        return $error;
        exit;
        } */

        /* if ($minustes > 30) {
        $error['code'] = 2;
        $error['msg'] = "maximum 30 mins Required to Schedule the session";
        return $error;
        exit;
        } */

        // exit;
        $response2 = $this->coviuImplement($request);
        $entry_url = $response2['participants'][0]['entry_url'];
        $entry_url_doctor = $response2['participants'][1]['entry_url'];
        // dd($response2);
        $appointment_id = $this->AppointmentAddToDB($request->doctor_id, $appointment_time[0], $appointment_time[1], $entry_url, $entry_url_doctor);
        //exit;
        $response = $this->paymentImplement($request);
        if ($response['id'] == 1 && $response['text'] == 'SUCCESS' && $response['code'] == 100) {
            $appointment = Appointment::find($appointment_id);
            $appointment->status = 1;
            $appointment->transaction_id = $response['transaction_id'];
            $appointment->save();
            $msg['code'] = 1;
            $msg['msg'] = "Request has been Schedule";
            return $msg;
        }
        $msg['code'] = 2;
        $msg['msg'] = $response['text'];
        return $msg;
        // dd($response, $response2);
    }

    public function coviuImplement($request)
    {

        //Set Time Zone
        date_default_timezone_set("Asia/Karachi");
        $appointment_time = explode(" - ", $request->appointment_time);
        $doctor = $this->CentralController->getDoctorById($request->doctor_id);

        $session = array(
            'session_name' => 'A test session with ' . $doctor->name,
            'start_time' => date(DATE_ATOM, strtotime($appointment_time[0])),
            'end_time' => date(DATE_ATOM, strtotime($appointment_time[1])),
            'picture' => 'http://www.fillmurray.com/200/300',
        );
        $session = $this->coviu->sessions->createSession($session);
        $host = array(
            'display_name' => 'Dr. ' . ucwords($doctor->name),
            'role' => 'host', // or 'guest'
            'picture' => 'http://fillmurray.com/200/300',
            'state' => 'test-state',
        );
        $participant = $this->coviu->sessions->addParticipant($session['session_id'], $host);
        $guest = array(
            'display_name' => 'Patient Guest',
            'role' => 'guest', // or 'guest'
            'picture' => 'http://fillmurray.com/200/300',
            'state' => 'test-state',
        );
        $participant = $this->coviu->sessions->addParticipant($session['session_id'], $guest);
        $sessions = $this->coviu->sessions->getSessions();
        // dd($sessions);
        // echo '<script>console.log("Session Registered!")</script>';

        return $this->coviu->sessions->getSession($session['session_id']);

    }

    public function paymentImplement(Request $request)
    {

        $amount = "50.00";
        $cc_number = "4111111111111111";
        $cvv_number = "1010";

        $this->PaymentMethodController->setLogin("6457Thfj624V5r7WUwc5v6a68Zsd6YEm");
        $result = $this->PaymentMethodController->doSale($amount, $cc_number, $cvv_number);

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
        if ($response['id'] == 1 && $response['text'] == 'SUCCESS' && $response['code'] == 100) {
            // echo '<script>console.log("Payment Done!")</script>';
            $this->paymentAddToDB($cc_number, $cvv_number, $amount, $transaction_id);
            // echo '<script>console.log("Payment Add To DB!")</script>';
            // dd($response);
        }

        return $response;
    }

    protected function paymentAddToDB($cc_number, $cvv_number, $amount, $transaction_id)
    {
        $paymentAddToDB = new Payment();
        $paymentAddToDB->patient_id = Auth::guard('patient')->user()->id;
        $paymentAddToDB->cc_number = $cc_number;
        $paymentAddToDB->cvv_number = $cvv_number;
        $paymentAddToDB->amount = $amount;
        $paymentAddToDB->transaction_id = $transaction_id;
        if ($paymentAddToDB->save()) {
            return 1;
        }

    }

    protected function AppointmentAddToDB($doctor_id, $date_time_start, $date_time_end, $entry_url, $entry_url_doctor)
    {
        $appointmentAddToDB = new Appointment();
        $appointmentAddToDB->doctor_id = $doctor_id;
        $appointmentAddToDB->patient_id = Auth::guard('patient')->user()->id;
        $appointmentAddToDB->date_time_start = $date_time_start;
        $appointmentAddToDB->date_time_end = $date_time_end;
        $appointmentAddToDB->status = 0;
        $appointmentAddToDB->entry_url = $entry_url;
        $appointmentAddToDB->entry_url_doctor = $entry_url_doctor;
        if ($appointmentAddToDB->save()) {
            return $appointmentAddToDB->appointment_id;
        }

    }

    protected function checkDateTime($date1, $date2)
    {
        // Declare and define two dates
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);

        // Formulate the Difference between two dates
        $diff = abs($date2 - $date1);

        // To get the year divide the resultant date into
        // total seconds in a year (365*60*60*24)
        $years = floor($diff / (365 * 60 * 60 * 24));

        // To get the month, subtract it with years and
        // divide the resultant date into
        // total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

        // To get the day, subtract it with years and
        // months and divide the resultant date into
        // total seconds in a days (60*60*24)
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        // To get the hour, subtract it with years,
        // months & seconds and divide the resultant
        // date into total seconds in a hours (60*60)
        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

        // To get the minutes, subtract it with years,
        // months, seconds and hours and divide the
        // resultant date into total seconds i.e. 60
        return $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);

        // To get the minutes, subtract it with years,
        // months, seconds, hours and minutes
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));

    }

}

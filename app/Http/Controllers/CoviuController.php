<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DoctorModel as Doctor;
use App\Model\CountryAndStatesModel as CountryAndStates;
use App\Model\SpecilitizationModel as Specilitization;
use App\Model\DoctorAvalibilityModel as DoctorAvalibility;
use coviu\Api\Coviu;
use Auth;
use Hash;
use View;

class CoviuController extends Controller
{
    protected $coviu;
    public function __construct(Request $request, Coviu $coviu)
    {
         $coviu = new Coviu(env('COVIU_API_KEY'), env('COVIU_SECRETE_KEY'));
        
    }

    public function getState1(Request $request)
    { 
        return $state = CountryAndStates::select('id', 'title')->where('status', 1)->where('child_id', $request->id)->get()->toArray();
        // dd($country);

    }

}
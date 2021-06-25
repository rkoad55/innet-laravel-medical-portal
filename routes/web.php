<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|php artisan make:middleware AuthDoctors
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/confirm-doctor/{token}', 'Doctor\DoctorverificationController@index')->name('doctor.verification');
Route::get('/confirm-patient/{token}', 'Patient\PatientverificationController@index')->name('patient.verification');
Route::post('/getstate', 'CentralController@getState')->name('getstate');
Route::post('/getcity', 'CentralController@getCity')->name('getcity');



/*---------------------------------------------------------------------------------------
---------------------------------------Admin Routes-------------------------------------
---------------------------------------------------------------------------------------*/

// Route::group(['prefix' => 'doctor', 'namespace' => 'Doctor'], function(){
    Route::namespace('Admin')->prefix('admin')->group(function(){
        Route::get('/', function () { return redirect()->route('admin.login'); });
            // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Auth\LoginController@attemptLogin')->name('admin.login.post');
        Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::patch('/doctorstatus', 'AdminController@setDoctorStatus')->name('admin.doctorstatus');
        Route::patch('/patientstatus', 'AdminController@setPatientStatus')->name('admin.patientstatus');
        Route::get('/profile', 'AdminController@getProfile')->name('admin.profile');
        Route::post('/profilesubmit', 'AdminController@submitAdminInformation')->name('admin.profilesubmit');
        Route::post('payment/{transactionid}/refund', 'AdminController@postRefund')->name('post.refund');
        Route::post('/passwordreset', 'AdminController@passwordReset')->name('admin.passwordreset');
        Route::patch('appointment/change_status', 'AdminController@changeStatus');
        Route::get('/appointment/{date?}', 'AdminController@adminAppointment')->name('admin.appointment.date');

        Route::get('/doctorlist', function(){
            $page_title = "All Doctor List";
            return view('admin.doctor.doctor-list', compact('page_title'));
        });
        Route::get('/patientlist', function(){
            $page_title = "All Patient List";
            return view('admin.patient.patient-list', compact('page_title'));
        });

        //Departments
        Route::get('department/{id}/doctorlist', 'DepartmentController@getDepartmentRelatedDoctors');
        Route::get('department/{id}/patientlist', 'DepartmentController@getDepartmentRelatedPatients');
        Route::delete('department/imagedelete/{id}/imagedel', 'DepartmentController@deleteImage');
        Route::patch('department/change_status', 'DepartmentController@changeStatus');
        Route::post('department/position', 'DepartmentController@setPosition');
        Route::resource('department', 'DepartmentController');
        
        /* // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register')->name('admin.register.post');
        
        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
        
             Route::get('/dashboard', 'DoctorController@index')->name('doctor.dashboard');
            Route::post('/profilesubmit', 'DoctorController@submitDoctorInformation')->name('doctor.profilesubmit');
            Route::post('/avalibilitysubmit', 'DoctorController@submitAvalibility')->name('doctor.avalibilitysubmit');
        
            Route::get('/appointment', 'DoctorController@DoctorAppointment')->name('doctor.appointment');
        
        
            Route::get('/profile', 'DoctorController@DoctorProfile')->name('doctor.profile'); */
           
        });


/*---------------------------------------------------------------------------------------
---------------------------------------Doctor Routes-------------------------------------
---------------------------------------------------------------------------------------*/

// Route::group(['prefix' => 'doctor', 'namespace' => 'Doctor'], function(){
Route::namespace('Doctor')->prefix('doctor')->group(function(){
Route::get('/', function () { return redirect()->route('login'); });
    // Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@attemptLogin')->name('doctor.login.post');
Route::post('logout', 'Auth\LoginController@logout')->name('doctor.logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('doctor.register.post');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('doctor.password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('doctor.password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('doctor.password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('doctor.password.update');

// Route::group(['middleware' => ['']], function(){
// Route::group( function(){
    Route::get('/dashboard', 'DoctorController@index')->name('doctor.dashboard');
    Route::post('/profilesubmit', 'DoctorController@submitDoctorInformation')->name('doctor.profilesubmit');
    Route::post('/avalibilitysubmit', 'DoctorController@submitAvalibility')->name('doctor.avalibilitysubmit');

    Route::get('/appointment', 'DoctorController@DoctorAppointment')->name('doctor.appointment');


    Route::get('/profile', 'DoctorController@DoctorProfile')->name('doctor.profile');
// });
   
});




/*---------------------------------------------------------------------------------------
---------------------------------------Patient Routes-------------------------------------
---------------------------------------------------------------------------------------*/

Route::namespace('Patient')->prefix('patient')->group(function(){

    Route::get('/', function () { return redirect()->route('patient.login'); });
    // Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('patient.login');
Route::post('login', 'Auth\LoginController@attemptLogin')->name('patient.login.post');
Route::post('logout', 'Auth\LoginController@logout')->name('patient.logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('patient.register');
Route::post('register', 'Auth\RegisterController@register')->name('patient.register.post');

// Password Reset Routes....
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('patient.password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('patient.password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('patient.password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('patient.password.update');

Route::get('/dashboard', 'PatientController@index')->name('patient.dashboard');
Route::post('/profilesubmit', 'PatientController@submitPatientInformation')->name('patient.profilesubmit');
Route::post('/mentalhealthsubmit', 'PatientController@submitPatientMentalhealth')->name('patient.mentalhealthsubmit');
Route::post('/pasthistorysubmit', 'PatientController@submitPatientPastHistory')->name('patient.pasthistorysubmit');
Route::get('/insurancesubmit', 'PatientController@submitPatientInsuranceInformation')->name('patient.insurancesubmit');
Route::get('/profile', 'PatientController@PatientProfile')->name('patient.profile');
Route::get('/appointment', 'PatientController@PatientAppointment')->name('patient.appointment');
Route::post('/payment', 'PatientController@AddPaymentDetail')->name('patient.payment');
Route::get('/appointment/{doctor_id}/booking', 'PatientController@appointmentBooking')->name('patient.appointment.booking');
Route::post('/appointment/bookingsubmit', 'PatientController@appointmentBookingSubmit')->name('patient.appointment.bookingsubmit');

Route::get('/doctorlist', function(){
        return view('patient.appointment.list');
    });
// Route::get('/doctorlist', 'PatientController@getDoctors');
   
});




// Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

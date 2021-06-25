<!-- Profile Image -->
@php
$patient_appointment = $CentralController->getPatientAppointment(Auth::guard('patient')->user()->id);
@endphp

<div class="card card-danger  card-outline card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ strlen(Auth::guard('patient')->user()->image)?asset('thumbs/'.Auth::guard('patient')->user()->image):asset('images/default_user.jpg') }}" alt="{{Auth::guard('patient')->user()->name}}">
                </div>

                <h3 class="profile-username text-center">{{Auth::guard('patient')->user()->name}}</h3>

                <p class="text-muted text-center">Patient</p>

                <ul class="list-group list-group-unbordered mb-3">
                @if(count($patient_appointment))
                    <?php $i = 1; ?>
                    @foreach($patient_appointment as $key => $value)
                      @php $doctor = $CentralController->getDoctorById($patient_appointment[$key]['doctor_id']); @endphp
                      <li class="list-group-item">
                      <div><b> {{$i}}. Appointment Time</b></div> <p><a class="float-left">{{ date('h:i A', strtotime($value['date_time_start'])) }} - {{ date('h:i A', strtotime($value['date_time_end'])) }}</a></p>
                      
                      <div style="margin-top: 40px;clear:both;display:block;"><b style="display:block;clear:both;">Dr. Name</b></div> <p><a class="float-left">@if(!empty($doctor)) {{$doctor->name}} {{$doctor->middle_name}} {{$doctor->last_name}} @endif</a></p>
                      
                      <a style="display:block;clear:both;" class="" target="_blank" href="{{$value['entry_url']}}"><b>Click to Start Session</b> </a>
                      </li>
                      <?php $i++; ?>

                    @endforeach
                @endif
                </ul>

              </div>
            </div>
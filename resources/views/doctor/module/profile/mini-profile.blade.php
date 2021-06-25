<!-- Profile Image -->
<div class="card card-danger card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ strlen(Auth::guard('doctor')->user()->image)?asset('thumbs/'.Auth::guard('doctor')->user()->image):asset('images/default_user.jpg') }}" alt="Dr. {{Auth::guard('doctor')->user()->name}}">
                </div>

                <h3 class="profile-username text-center">{{Auth::guard('doctor')->user()->name}}</h3>

                <p class="text-muted text-center">Doctor</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Today's</b> <a class="float-right">{{ $CentralController->getDoctorAppointmentCounter(Auth::guard('doctor')->user()->id,'today') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Week</b> <a class="float-right">{{ $CentralController->getDoctorAppointmentCounter(Auth::guard('doctor')->user()->id,'week') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Months</b> <a class="float-right">{{ $CentralController->getDoctorAppointmentCounter(Auth::guard('doctor')->user()->id,'month') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Year</b> <a class="float-right">{{ $CentralController->getDoctorAppointmentCounter(Auth::guard('doctor')->user()->id,'year') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Done</b> <a class="float-right">{{ $CentralController->getDoctorAppointmentCounter(Auth::guard('doctor')->user()->id,'all') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Refund</b> <a class="float-right">{{ $CentralController->getDoctorAppointmentCounter(Auth::guard('doctor')->user()->id,'refund') }}</a>
                  </li>
                </ul>

              </div>
            </div>
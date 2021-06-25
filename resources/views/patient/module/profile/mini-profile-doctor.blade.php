

<div class="card card-danger  card-outline card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ strlen($doctor->image)?asset('thumbs/'.$doctor->image):asset('images/default_user.jpg') }}" alt="{{$doctor->name}}">
                </div>

                <h3 class="profile-username text-center">{{$doctor->name}} {{$doctor->middle_name }} {{$doctor->last_name }}</h3>

                <p class="text-muted text-center">Doctor</p>

              </div>
            </div>
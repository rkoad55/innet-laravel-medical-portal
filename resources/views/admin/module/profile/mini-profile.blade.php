<!-- Profile Image -->
<div class="card card-danger card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ strlen(Auth::guard('admin')->user()->image)?asset('thumbs/'.Auth::guard('admin')->user()->image):asset('images/default_user.jpg') }}" alt="Dr. {{Auth::guard('admin')->user()->name}}">
                </div>

                <h3 class="profile-username text-center">{{Auth::guard('admin')->user()->name}}</h3>

                <p class="text-muted text-center">Admin</p>

                

              </div>
            </div>
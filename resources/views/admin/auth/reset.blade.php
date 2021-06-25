<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Doctor | Reset Password</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <link rel="icon" type="image/png" href="{{asset('/images/favicon.png')}}">

</head>
<body class="hold-transition login-page">
  {{--dd($specilitization)--}}
  <div class="login-box">
    <div class="login-logo">
    <img src="{{asset('images/logo.png')}}" alt="innet" title="innet" class="mainlogo" />

      <a href="" style="display:block"><b>Enter New Password</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">{{$form_msg}}</p>
        @if(Session::has('error'))
        <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
      @endif

        <form action="{{ route('doctor.password.update') }}" method="post" role="form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group has-error input-group mb-3 @error('email')is-invalid has-error @enderror">
          <input type="email" class="form-control" value="{{old('email') }}" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text @error('email')text-danger @enderror">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
                    
                    
        </div>
        @error('email')
        <p class="help-block text-danger">
          <strong>{{$message}}</strong>
        </p>
        @enderror
          <!-- ------------------------------------------------------------------------------------------------------------ -->
          <div class="form-group has-error input-group mb-3 @error('password')is-invalid has-error @enderror">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text @error('password')text-danger @enderror">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            
            
          </div>
          @error('password')
          <p class="help-block text-danger">
            <strong>{{$message}}</strong>
          </p>
          @enderror
          <!-- ------------------------------------------------------------------------------------------------------------ -->
          <div class="form-group has-error input-group mb-3 @error('password_confirmation')is-invalid has-error @enderror">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text @error('password_confirmation')text-danger @enderror">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            
            
          </div>
          @error('password_confirmation')
          <p class="help-block text-danger">
            <strong>{{$message}}</strong>
          </p>
          @enderror
          <!-- ------------------------------------------------------------------------------------------------------------ -->
          <div class="col-4 center">
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          
        </form>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
      });
  </script>

</body>

</html>
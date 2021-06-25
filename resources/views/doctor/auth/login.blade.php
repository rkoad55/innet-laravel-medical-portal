<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Doctor | Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <link rel="icon" type="image/png" href="{{asset('/images/favicon.png')}}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
  
    <div class="login-logo">
      <img src="{{asset('images/logo.png')}}" alt="innet" title="innet" class="mainlogo" />
      <a href="" style="display:block"><b>Doctor</b>Dashboard</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @if(Session::has('error'))
        <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
      @endif

        <form action="{{route('doctor.login.post')}}" method="post" role="form">
        @csrf

          <div class="form-group has-error input-group mb-3 @error('email')is-invalid has-error @enderror">
            <input type="email" class="form-control" name="email" placeholder="Email">
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
          <div class="row">
            <div class="col-8">
              <div class="icheck-danger">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-danger btn-block">Sign In</button>
            </div>
          </div>
        </form>
        <p class="mb-1">
          <a href="{{url('/doctor/password/reset')}}">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="{{url('/doctor/register')}}" class="text-center">Register a new membership</a>
        </p>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
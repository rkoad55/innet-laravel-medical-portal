<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Doctor | Password Reset<</title>
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
      <a href="" style="display:block"><b>{{ __('Dr. Password Reset') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Enter your email to reset password</p>
        @if(Session::has('error'))
        <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
      @endif
      @if (session('status'))
        <div class="alert alert-success" role="alert">
        {{ session('status') }}
        </div>
        @endif

        <form action="{{ route('doctor.password.email') }}" method="post" role="form">
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
            
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-danger btn-block">{{ __('Send Password Reset Link') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient | Registration</title>
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

      <a href="" style="display:block"><b>Patient Registration</b></a>
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

        <form action="{{route('patient.register.post')}}" method="post" role="form">
        @csrf

        <div class="form-group has-error input-group mb-3 @error('name')is-invalid has-error @enderror">
            <input type="text" class="form-control" value="{{old('name') }}" name="name" placeholder="Full Name">
            <div class="input-group-append">
              <div class="input-group-text @error('name')text-danger @enderror">
                <span class="fas fa-user"></span>
              </div>
            </div>
                
           
          </div>
          @error('name')
          <p class="help-block text-danger">
                    <strong>{{$message}}</strong>
                </p>
            @enderror
<!-- ------------------------------------------------------------------------------------------------------------ -->
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
            <?php
              $depart_return = array();
             if(is_array(old('depart')) && count(old('depart'))){
                $depart_return = old('depart');
              }
             ?>
          <div class="form-group input-group mb-3 select2-danger">
                    <select class="select2" multiple="multiple" value="" name="depart[]" data-placeholder="Select Department" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach($depart as $key => $value)  
                      <option {{ (in_array($value['id'], $depart_return))?'selected=selected':'' }} value="{{$value['id']}}">{{$value['title']}}</option>
                    @endforeach  
                     
                    </select>
                    
                </div>
                @error('depart')
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
              <button type="submit" class="btn btn-danger btn-block">Sign Up</button>
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
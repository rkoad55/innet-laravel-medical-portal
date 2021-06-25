<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Patient | Dashboard</title>
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/popper/popper.min.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/googleicon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <link rel="icon" type="image/png" href="{{asset('/images/favicon.png')}}">


</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark navbar-danger">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          @if(Auth::guard('patient')->check())
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Welcome {{ Auth::guard('patient')->user()->name }} <span class="caret"></span>
          </a>
            @endif

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('patient.logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('patient.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-danger elevation-4 navbar-danger">
      <a href="{{ url('/patient/dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/P.png') }}" alt="Doctors Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Patient Dashboard</span>
      </a>
        <div class="sidebar">
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-header">Menu</li>
              @if(!is_null(Auth::guard('patient')->user()->email_verified_at) && Auth::guard('patient')->user()->hr_approval != 0)

              <li class="nav-item">
                <a href="{{ url('/admin/menu') }}" class="nav-link">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Menu</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="{{ url('/patient/profile') }}" class="nav-link {{ (Request::segment('2') == 'profile')?'active':'' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/patient/appointment') }}" class="nav-link {{ (Request::segment('2') == 'appointment')?'active':'' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Appointment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/patient/doctorlist') }}" class="nav-link {{ (Request::segment('2') == 'doctorlist')?'active':'' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Doctors List</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
    </aside>

    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{isset($page_title)?$page_title:'Welcome To iNETT'}}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('status'))
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
            {{ Session::get('status') }}.
            </div>
            </div>
          </div>
          </div>
        </div>
      </section>
      @endif
      @if(is_null(Auth::guard('patient')->user()->email_verified_at))
      <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  Thank you for signing up
                </h3>
              </div>
              <div class="card-body">
                <div class="alert alert-warning alert-dismissible">
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  A verification email has been sent to your registered email address. Kindly Verify your email first.
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>
      @else
          @yield('content')
      @endif
    </div>



    <footer class="main-footer">

      <div class="float-right d-none d-sm-inline-block">
      </div>
      <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      </script>
      <style>
      .hide{
        display:none;

      }
      </style>

    </footer>
  </div>
  <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/demo.js') }}"></script>


</body>
</html>

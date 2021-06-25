<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin | Dashboard</title>
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>

  <script src="{{-- asset('assets/plugins/popper/popper.min.js') --}}"></script>

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
          @if(Auth::guard('admin')->check())    
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Welcome {{ ucwords(Auth::guard('admin')->user()->name) }} <span class="caret"></span>
          </a>
            @endif  

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                    {{ __('Profile') }}  
                </a>

                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}  
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-danger elevation-4 navbar-danger">
      <a href="{{ url('/admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/A.png') }}" alt="admins Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span>
      </a>
        <div class="sidebar">
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="{{ url('/admin/doctorlist') }}" class="nav-link {{ (Request::segment('2') == 'doctorlist')?'active':'' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Doctor List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('/admin/patientlist') }}" class="nav-link {{ (Request::segment('2') == 'patientlist')?'active':'' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Patient List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/department') }}" class="nav-link {{ (Request::segment('2') == 'department')?'active':'' }}">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Departments</p>
                </a>
              </li>

              <li class="nav-item has-treeview {{ (Request::segment('2') == 'appointment')?'menu-open':'' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>Appointment<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview" style="{{ (Request::segment('2') == 'appointment')?'display: block':'display: none' }};">
               
                  <li class="nav-item">
                    <a href="{{url('/admin/appointment/today')}}" class="nav-link {{ (Request::segment('3') == 'today')?'active':'' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Today</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/appointment/week')}}" class="nav-link {{ (Request::segment('3') == 'week')?'active':'' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Week</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/appointment/month')}}" class="nav-link {{ (Request::segment('3') == 'month')?'active':'' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Month</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/appointment/year')}}" class="nav-link {{ (Request::segment('3') == 'year')?'active':'' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Year</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/admin/appointment/all')}}" class="nav-link {{ (Request::segment('3') == 'all' && Request::segment('2') == 'appointment')?'active':'' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All</p>
                    </a>
                  </li>
                </ul>
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
        @if(Session::has('status'))
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
              {{ Session::get('status') }}.
            </div>
          </div>
      @endif
    </div><!-- /.container-fluid -->
    </section>

      @if(is_null(Auth::guard('admin')->user()->email_verified_at))
      @endif
      @yield('content')


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
@extends('layouts.app2')
@section('content')
<?php $doctor = $CentralController->getAllDoctors(); ?>
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Make Appointment</h3>
              <div class="card-tools">
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Book Appointment</th>
                </tr>
                </thead>
                <tbody>
                @if(count($doctor))
                @foreach($doctor as $key => $value)
                <tr id="cmsrow_{{$value->id}}">
                  <td><img src="{{strlen($value->image)?asset('thumbs/'.$value->image):asset('images/default_user.jpg')}}" /></td>
                  <td>{{$value->name}} {{$value->middle_name}} {{$value->last_name}}</td>
                  <td>
                  <a href="{{url('/patient/appointment/'.$value->id.'/booking')}}"><i class="fa fa-fw fa-book" aria-hidden="true"></i>&nbsp;</a>

                  </td>
                  
                </tr>
                @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                <th>Image</th>
                <th>Name</th>
                  <th>Book Appointment</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
        </div>
    </section>
      
      <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

      <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "orderable": false,
    });  
});  
</script>


@endsection

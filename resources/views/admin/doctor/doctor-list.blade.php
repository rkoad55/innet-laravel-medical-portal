@extends('layouts.app3')

@section('content')
<?php
if(isset($check) && $check == 'Department Doctors'){
  $doctor = $department_doctor;
}else{
  $doctor = $CentralController->getAllDoctors();
}

 ?>
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
                  <th>Detail</th>
                  <th>Book Appointment</th>
                </tr>
                </thead>
                <tbody>
                @if(count($doctor))
                @foreach($doctor as $key => $value)
                <?php
                    $doctor_avalibility = $CentralController->getDoctorAvalibilityById($value->id);
                    $doctor_specialization = $CentralController->getSpecializationById($value->specialization_id);
                    
                ?>
                <tr id="cmsrow_{{$value->id}}">
                  <td><img src="{{strlen($value->image)?asset('thumbs/'.$value->image):asset('images/default_user.jpg')}}" /></td>
                  <td>
                    <p><b>Name:</b> {{$value->name}} {{$value->middle_name}} {{$value->last_name}}</p>
                    @if(count($doctor_avalibility))
                      <p><b>Avalibility:</b> {{ $doctor_avalibility['monday'] ?'Monday,': '' }} {{ $doctor_avalibility['tuesday'] ?'Tuesday,': '' }} {{ $doctor_avalibility['wednesday'] ?'Wednesday,': '' }}
                      {{ $doctor_avalibility['thursday'] ?'Thursday,': '' }} {{ $doctor_avalibility['friday'] ?'Friday,': '' }} {{ $doctor_avalibility['saturday'] ?'Saturday,': '' }} {{ $doctor_avalibility['sunday'] ?'Sunday,': '' }}
                     </p>
                    @else
                      <p><b>Avalibility:</b> None </p>
                    @endif
                    @if(count($doctor_specialization))
                        <?php $doctor_specialization_str = implode(", ", array_column($doctor_specialization, 'title')); ?>
                      
                        <p><b>Department:</b> {{$doctor_specialization_str}}</p>
                    @else
                        <p><b>Department:</b> None</p>
                    @endif
                  
                  </td>
                  <td>
                  <div class="btn-group" id="statusBtn_{{$value->id}}">
                      @if($value->status == 1)
                        <button type="button" class="btn btn-success btn-flat">Active</button>
                        <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" title="Click to In-active" onclick="change_status({{ $value->id }},0)">Inactive</a>
                        </div>
                        </button>
                        @else
                        <button type="button" class="btn btn-danger btn-flat">Inactive</button>
                        <button type="button" class="btn btn-danger btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" title="Click to Active" onclick="change_status({{ $value->id}},1)">Active</a>
                        </div>
                        </button>
                      @endif
                    </div>
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

function change_status(id, cstatus){
var status = "";
if(cstatus==0){
status = 'In-active';
}else{
status = 'Active';
}
var a = confirm('Are you sure you want to '+status+' Record');

if(a==true){
//call ajax function to send request
$.ajax({
type: "post",
url: "{{ route('admin.doctorstatus') }}",
data: {_method: 'PATCH','status':cstatus,'id':id},
cache: false,
success: function(data){
  if(data==1){
    var btn = "";
		if(cstatus==0){
      btn += '<button type="button" class="btn btn-danger btn-flat">Inactive</button>'+
                      '<button type="button" class="btn btn-danger btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                      '<span class="sr-only">Toggle Dropdown</span>'+
                       '<div class="dropdown-menu" role="menu">'+
                          '<a class="dropdown-item" title="Click to Active" onclick="change_status('+id+',1)"">Active</a>'+
                       '</div>'+
                    '</button>';
			 $('#statusBtn_'+id).html(btn);
		}else{
      btn += '<button type="button" class="btn btn-success btn-flat">Active</button>'+
                      '<button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
                      '<span class="sr-only">Toggle Dropdown</span>'+
                      '<div class="dropdown-menu" role="menu">'+
                          '<a class="dropdown-item" title="Click to In-active" onclick="change_status('+id+',0)">Inactive</a>'+
                       '</div>'+
                    '</button>';

		   $('#statusBtn_'+id).html(btn);
		}
		//display message to slide down
		$('#msg').removeClass('alert-warning').addClass('alert-success').html('Status has been changes successfully');
		$("#msg").slideDown().delay(2000).slideUp();
  }
  //if any error/exception
  else{                
		$('#msg').removeClass('alert-success').addClass('alert-warning').html('Something went wrong, please try again!');
  }  
}
});
}else{
return false;
}
}
</script>

@endsection
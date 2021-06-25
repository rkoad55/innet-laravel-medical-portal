@extends('layouts.app3')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

  <section class="content">

      <div class="row">
        <div class="col-12">
          <div class="card card-dark  card-outline">
            <div class="card-header">
              <h3 class="card-title">Departments</h3>
              <div class="card-tools">
                <a href="{{ url('admin/appointment/create') }}" class="btn btn-dark">Add Appointment</a>
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ Form::open(array('url' => '/admin/appointment/position', 'id' => 'appointment-position', 'role' => 'form')) }}
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @if(count($appointment))
                @foreach($appointment as $key => $value)
                <tr id="row_{{$value->id}}">
                  <td>{{$value->title}}</td>
                  <td>
                  <div id="statusBtn_{{$value->id}}" class="btn-group">
                  @if($value->status == 1)
                      <button type="button" class="btn btn-success btn-flat">Active</button>
                      <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                       <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" title="Click to In-active" onclick="change_status('{{ $value->id }}',0)">Inactive</a>
                       </div>
                    </button>
                  @else
                      <button type="button" class="btn btn-dark btn-flat">Inactive</button>
                      <button type="button" class="btn btn-dark btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                       <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" title="Click to Active" onclick="change_status('{{ $value->id }}',1)">Active</a>
                       </div>
                    </button>
                  @endif
                    
                  </div>
                  </td>
                  <td>
                    <a href="{{url('/admin/appointment/'.$value->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i>&nbsp;</a>
                    &nbsp;
                    <a class = "formConfirm" data-toggle="modal" data-target="#modal-default" data-form="#formConfirm-{{$value->id}}-appointment-row_" data-title="Delete Page" data-message="Are you sure you want to delete this Page?" href="javascript:void(0);"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                  </td>
                  <td>
                    <a href="{{url('/admin/appointment/'.$value->id.'/doctorlist')}}">Doctors&nbsp;</a>
                    &nbsp;
                    <a href="{{url('/admin/appointment/'.$value->id.'/patientlist')}}">Patients&nbsp;</a>
                  </td>
                  
                </tr>
                @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>&nbsp;</th>
                </tr>
                </tfoot>
              </table>
                {{ Form::close() }}
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
      url: "{{ url('admin/appointment/change_status') }}",
      data: {_method: 'PATCH','status':cstatus,'id':id},
      cache: false,
      success: function(data){
        // console.log(data);
        if(data==1){
          var btn = "";
          if(cstatus==0){
            btn += '<button type="button" class="btn btn-dark btn-flat">Inactive</button>'+
                            '<button type="button" class="btn btn-dark btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">'+
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
@include('common.confirm-delete')

@endsection

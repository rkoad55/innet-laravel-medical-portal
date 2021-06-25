@extends('layouts.app3')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<?php $appointment = $CentralController->getAllAppointment($date); dd($appointment); ?>
  <section class="content">

      <div class="row">
        <div class="col-12">
          <div class="card card-dark  card-outline">
            <div class="card-header">
              <h3 class="card-title">{{strlen($date)?ucfirst($date):'All'}} Appointment</h3>
              <div class="card-tools">
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ Form::open(array('url' => '/admin/appointment/position', 'id' => 'appointment-position', 'role' => 'form')) }}
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Doctor Name</th>
                  <th>Patient Name</th>
                  <th>Appointment Time</th>
                  <th>Ammount</th>
                  <th>Refund Ammount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($appointment))
                @foreach($appointment as $key => $value)
                <?php
                 $doctor = $CentralController->getDoctorById($value->doctor_id);
                 $patient = $CentralController->getPatientById($value->patient_id);
                 $start = explode(" ", $value->date_time_start);
                 $end = explode(" ", $value->date_time_end);
                 $start_time = $start[1].' '. $start[2];
                 $end_time = $end[1].' '. $end[2];
                // dd($start, $end);
                ?>
                <tr id="row_{{$value->transaction_id}}">
                  @if(!empty($doctor))
                    <td>{{$doctor->name}} {{$doctor->middle_name}} {{$doctor->last_name}}</td>
                  @else
                    <td>&nbsp;</td>
                  @endif
                  @if(!empty($patient))
                    <td>{{$patient->name}} {{$patient->middle_name}} {{$patient->last_name}}</td>
                    @else
                    <td>&nbsp;</td>
                  @endif
                  <td>{{$start_time}} - {{$end_time}}</td>
                  <td>{{strlen($value->amount)?'$'.$value->amount:''}}</td>
                  <td id="{{$value->transaction_id}}">{{strlen($value->refund_amount)?'$'.$value->refund_amount:''}}</td>
                  <td>{{date('d-m-y', strtotime($patient->created_at))}}</td>
                  <td>
                    <a class = "formRefund" data-toggle="modal" data-target="#modal-default" data-form="#formRefund-{{$value->transaction_id}}-{{$value->amount}}-payment-row_" data-title="Refund Page" data-message="Are you sure you want to Refund this transaction ?" href="javascript:void(0);"> Refund </a>
                   </td>
                  
                  
                </tr>
                @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                <th>Doctor Name</th>
                  <th>Patient Name</th>
                  <th>Appointment Time</th>
                  <th>Date</th>
                  <th>Ammount</th>
                  <th>Refund Ammount</th>
                  <th>Action</th>
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
      </script>
@include('common.confirm-refund')

@endsection
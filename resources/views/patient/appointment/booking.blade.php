@extends('layouts.app2')
@section('content')
<?php 

$slots = $CentralController->getDoctorAvalibilityById($doctor->id);
$approved_appointment = $CentralController->getAppointmentBetweenDoctorAndPatient(Auth::guard('patient')->user()->id, $doctor->id);
// dd($slots);
if(!empty($slots)){
  $slot_day = $slots[strtolower(date('l'))];
  if($slot_day == 1){
    $slot_start_at = $slots[strtolower(date('l')).'_start_at'];
    $slot_end_at = $slots[strtolower(date('l')).'_end_at'];
    $date_first = date('Y-m-d ').$slot_start_at;
    $date_second = date('Y-m-d ').$slot_end_at;
    $interval = 1800; // Interval in seconds
    $time_first     = strtotime($date_first);
    $time_second    = strtotime($date_second);
  }
}
  
  ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">
          @include('patient.module.profile.mini-profile-doctor')
          @include('patient.module.profile.aboutme-doctor')
        </div>
        <div class="col-md-9">

            <div class="card card-danger  card-outline">
                <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Avaliable Slots</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              
              <div class="card-body overlay-wrapper">
              <div class="overlay hide" style="display:none"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Wait please...</div></div>
                @if(!empty($slots) && $slot_day == 1)
                    <form role="form" id="form" class="form-horizontal" novalidate="novalidate">
                    <input type="hidden" value="{{$doctor->id}}" name="doctor_id" >
                  
                      @for($i = $time_first; $i < $time_second; $i += $interval)
                      <!-- ------------------------------------------------------------------------------------------- -->
                      @php
                      $status = ""; 
                        $full_date = date('m/d/Y h:i A', $i).' - '.date("m/d/Y h:i A", $i+$interval);
                        $time = date('h:i A', $i).' - '.date("h:i A", $i+$interval);
                       @endphp
                    <div class="row ">
                      <div class="col-md-3">
                        <label for="inputEmail3"  class=" col-form-label">{{$time}}</label>
                      </div>
                      <div class="col-md-2 form-group icheck-danger">
                        <?php


                         if (time() >= $i){
                          $status = '<span> Out of time</span>';
                        }else{
                          $status= '<input class="checkboxinline" type="checkbox" value="'.$full_date.'" name="appointment_time" id="checkboxDanger'.$i.'" ><label for="checkboxDanger'.$i.'"></label>';
                        }

                        foreach($approved_appointment as $key => $value){
                           $approved_appointment_full_date = $value['date_time_start'].' - '.$value['date_time_end'];
                            if($approved_appointment_full_date == $full_date){
                              $status = '<span><b> Your Appointment <b/></span>';
                        
                            }
                        }
                        
                        echo $status;
                        ?>
                      </div>
                      
                    </div>
                    @endfor
                    <!-- ------------------------------------------------------------------------------------------- -->
                     <!-- <div class="row">
                  <div class="form-group col-6 required">
                    <label for="appointment_time" clas="required">Full Name<span class="text-danger">*</span></label>
                    <input type="text" name="appointment_time" id="reservationtime" class="form-control" id="appointment_time" placeholder="Appointment Date time">
                  </div>
                  
                </div>  --> 
                   
                   
                    <!-- ----------------------------------------------------Alert---------------------------------- -->
                    <div class="row hide"  id="form-alert">
                        
                          
                       
                      </div>
                    
                    
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    </div>
                <div class="card-footer">
                  <button type="submit" id="submitbutton" name="submit" class="btn btn-danger">Submit</button>
                  <span class="hide" id="loading"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>
                </div>
                @else
                <div class="card-footer">
                  No Slots Avaliable
                </div>
                @endif
                
              </form>
            </div>

            </div>
      </div>
      </div>
    </section>
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#submitbutton').click(function() {
 			$("#form").validate({
        rules:{
          appointment_time: {required: true},
      },

      messages: {
        appointment_time: "Please Select Your Slot",
        
      },

      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
			submitHandler:function(form){
        //var fdata=new FormData(form);
        $('#loading').removeClass('hide').show();
        $('.overlay').removeClass('hide').show();

				var fdata=new FormData(form);
				$.ajax({
					type: "POST",
					url: '{{ route("patient.appointment.bookingsubmit") }}',
					data: fdata,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result)
					{

            $('.overlay').addClass('hide').hide();
              $('#loading').addClass('hide').hide();

            if(result['code'] == 1){
              var alert='<div class="col-md-12"><div class="alert alert-success alert-dismissible">'+result["msg"]+'.</div></div>';
              $('#form-alert').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

            }else if(result['code'] == 2){
              var alert='<div class="col-md-12"><div class="alert alert-danger alert-dismissible">'+result["msg"]+'.</div></div>';
              $('#form-alert').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

            }

						return false;
					}
				});
				
				return false;
			}
        });
        });

	
});

$('#reservationtime').daterangepicker({
   timePicker: true,
    timePickerIncrement: 5,
     locale: { format: 'MM/DD/YYYY hh:mm A' }
    });


    $("input:checkbox").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });
   

</script>
@endsection
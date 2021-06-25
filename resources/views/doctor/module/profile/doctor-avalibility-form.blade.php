<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger card-outline">
              <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Doctor Availibility <small></small></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <form role="form" id="form_avalibility" class="form-horizontal" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <?php 
                      $doctor_avalibility = $CentralController->getDoctorAvalibilityById(Auth::guard('doctor')->user()->id);
                      $days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
                      
                      ?>

                      @foreach($days as $key => $value)
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row ">
                      <div class="col-md-2">
                        <label for="inputEmail3" class=" col-form-label">{{ucfirst($value)}}</label>
                      </div>
                      <div class="col-md-2 form-group icheck-danger">
                        <input type="checkbox" name="{{$value}}" {{(isset($doctor_avalibility[$value])?'checked=""':'')}} id="checkboxDanger{{$value}}" class="checkboxinline " >
                        <label for="checkboxDanger{{$value}}"></label>
                      </div>
                      <div class=" col-md-4 form-group">
                        <input type="time"  min="09:00" max="18:00" class="form-control " value="{{(isset($doctor_avalibility[$value.'_start_at'])?$doctor_avalibility[$value.'_start_at']:'')}}" name="{{$value}}_start_at"  placeholder="Start Time">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="time"  class=" " value="{{(isset($doctor_avalibility[$value.'_end_at'])?$doctor_avalibility[$value.'_end_at']:'')}}" name="{{$value}}_end_at"  >
                      </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    @endforeach
                  
                    <!-- ----------------------------------------------------Alert---------------------------------- -->
                    <div class="row hide"  id="form-alert">
                        
                          
                       
                      </div>
                    
                    
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    </div>
                <div class="card-footer">
                  <button type="submit" id="submitbutton_avalibility" name="submit" class="btn btn-danger">Submit</button>
                  <span class="hide" id="loading_avalibility"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>
                </div>
              </form>
            </div>
            </div>
          <div class="col-md-6">
          </div>
        </div>
      </div>
    </section>

    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<!-- daterange picker -->


<script type="text/javascript">
$(document).ready(function(){
	$('#submitbutton_avalibility').click(function() {
    // alert($("#monday_start_at").val());
  $('#form_avalibility').validate({
    rules:
     {
       /* monday: {required: ($("#monday_start_at").val()!="" || $("#monday_end_at").val()!="")},
       tuesday: {required: ($("#tuesday_start_at").val()!="" || $("#tuesday_end_at").val()!="")},
       wednesday: {required: ($("#wednesday_start_at").val()!="" || $("#wednesday_end_at").val()!="")},
       thursday: {required: ($("#thursday_start_at").val()!="" || $("#thursday_end_at").val()!="")},
       friday: {required: ($("#friday_start_at").val()!="" || $("#friday_end_at").val()!="")},
       saturday: {required: ($("#saturday_start_at").val()!="" || $("#saturday_end_at").val()!="")},
       sunday: {required: ($("#sunday_start_at").val()!="" || $("#sunday_end_at").val()!="")}, */

      monday_start_at: {required: $('#monday').is(':checked')},
      monday_end_at: {required: $('#monday').is(':checked') && $("#monday_start_at").val()!=""},  
       tuesday_start_at: {required: $('#tuesday').is(':checked')},
      tuesday_end_at: {required: ($('#tuesday').is(':checked') && $("#tuesday_start_at").val()!="")},
      wednesday_start_at: {required: $('#wednesday').is(':checked')},
      wednesday_end_at: {required: ($('#wednesday').is(':checked') && $("#wednesday_start_at").val()!="")},
      thursday_start_at: {required: $('#thursday').is(':checked')},
      thursday_end_at: {required: ($('#thursday').is(':checked') && $("#thursday_start_at").val()!="")},
      friday_start_at: {required: $('#friday').is(':checked')},
      friday_end_at: {required: ($('#friday').is(':checked') && $("#friday_start_at").val()!="")},
      saturday_start_at: {required: $('#saturday').is(':checked')},
      saturday_end_at: {required: ($('#saturday').is(':checked') && $("#saturday_start_at").val()!="")},
      sunday_start_at: {required: $('#sunday').is(':checked')},
      sunday_end_at: {required: ($('#sunday').is(':checked') && $("#sunday_start_at").val()!="")}
    },
    messages:
     {
      // monday: "Please Check the Monday Field",
     monday_start_at: "Please Select Start Time For Monday",
     monday_end_at: "Please Select End Time For Monday",
      tuesday_start_at: "Please Select Start Time For Tuesday",
     tuesday_end_at: "Please Select End Time For Tuesday",
     wednesday_start_at: "Please Select Start Time For Wednesday",
     wednesday_end_at: "Please Select End Time For Wednesday",
     thursday_start_at: "Please Select Start Time For Thursday",
     thursday_end_at: "Please Select End Time For Thursday",
     friday_start_at: "Please Select Start Time For Friday",
     friday_end_at: "Please Select End Time For Friday",
     saturday_start_at: "Please Select Start Time For Saturday",
     saturday_end_at: "Please Select End Time For Saturday",
     sunday_start_at: "Please Select Start Time For Sunday",
     sunday_end_at: "Please Select End Time For Sunday",
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
        // alert($("#monday_start_at").val());
        $('#loading_avalibility').removeClass('hide').show();

				var fdata=new FormData(form);
				$.ajax({
					type: "POST",
					url: '{{route("doctor.avalibilitysubmit")}}',
					data: fdata,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result)
					{
            if(result == 1){
              var alert='<div class="col-md-12"><div class="alert alert-success alert-dismissible">'+
                              'Your Schedule has been Updated.'+
                            ' </div></div>';
              $('#loading_avalibility').addClass('hide').hide();
              $('#form_avalibility > #form-alert').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

            }else{
              var alert='<div class="col-md-12"><div class="alert alert-danger alert-dismissible">'+
                              'Something went wrong.'+
                            ' </div></div>';
              $('#loading_avalibility').addClass('hide').hide();
              $('#form_avalibility > #form-alert').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

            }
						return false;
					}
				});
				
				return false;
			}
  });
});
});





</script>
<!-- Latest compiled and minified CSS -->

<!-- Optional theme -->


<style>
  .form-group.required .control-label:after { 
   content:"*";
   color:red;
}
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single { border: 1px solid #d2d6de; border-radius: .25rem; padding: 6px 12px; height: 34px; } .select2-container .select2-selection--single .select2-selection__rendered { padding-right: 10px; } .select2-container .select2-selection--single .select2-selection__rendered { padding-left: 0; } .select2-container--default .select2-selection--single .select2-selection__arrow b { margin-top: 0; } .select2-container--default .select2-selection--single .select2-selection__arrow { height: 28px; right: 3px; } </style>
</style>

            
            <?php $patient_past_history = $CentralController->getPatientPastHistory( Auth::guard('patient')->user()->id ); //dd($patient_past_history[0]); ?>
            <div class="card card-danger  card-outline">
                <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Patient Past History</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <form role="form" action="{{route('patient.pasthistorysubmit')}}" id="mental_health" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-4 required">
                            <label for="allergies" clas="required">Allergies</label>
                            <input type="text" name="allergies" value="{{ count($patient_past_history) ? $patient_past_history[0]->allergies:'' }}" class="form-control" id="allergies">
                        </div>
                        <div class="form-group col-4">
                            <label for="current_weight" clas="required">Current Weight</label>
                            <input type="text" name="current_weight" value="{{ count($patient_past_history) ? $patient_past_history[0]->current_weight:'' }}" class="form-control" id="current_weight">
                        </div>
                        <div class="form-group col-4">
                            <label for="height" clas="required">Height</label>
                            <input type="text" name="height" value="{{ count($patient_past_history) ? $patient_past_history[0]->height:'' }}" class="form-control" id="height">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-8 required" >
                          <p for="inputEmail3" class=" col-form-label">List ALL current prescription medications and how often you take them  </p>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_current_prescription">
                          <input type="radio" name="current_prescription" {{ (count($patient_past_history) && $patient_past_history[0]->current_prescription == 'yes')?'checked=""':'' }} value="yes" onclick="showHideFunction('yes', 'current_prescription')" id="radioDanger_current_prescription" class="radioinline" >YES
                          <label for="radioDanger_current_prescription"></label>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_current_prescription2">
                          <input type="radio" name="current_prescription" {{ (count($patient_past_history) && $patient_past_history[0]->current_prescription == 'no')?'checked=""':'' }} value="no" onclick="showHideFunction('no', 'current_prescription')" id="radioDanger_current_prescription2" class="radioinline" >NO
                          <label for="radioDanger_current_prescription2"></label>
                        </div>
                      </div>
                      <!-- ---------------------------hide------------------------------ -->
                      <div class="{{ (count($patient_past_history) && $patient_past_history[0]->current_prescription == 'yes')?'':'hide' }}" id="current_prescription">
                        
                        <div class="row">
                              <div class="form-group col-4">
                                <label for="access_gun_explain" clas="required"> Medication Name.</label>
                              </div>
                              <div class="form-group col-4">
                                <label for="access_gun_explain" clas="required"> Total Daily Dosage.</label>
                              </div>
                              <div class="form-group col-4">
                                <label for="access_gun_explain" clas="required"> Estimated Start Date .</label>
                                  <div class="btn-group">
                                    <button type="button" id="add_med_list" class="btn btn-danger">+</button>
                                    <button type="button" id="remove_med_list" class="btn btn-danger">-</button>
                                  </div>
                              </div>
                          </div>
                          <div class="row" id="med">
                            <div id="1" style="width:100%;display:flex;">
                                <div class="form-group col-4">
                                <input type="text" name="med[1]['medicine_name']" class="form-control" id="med[1]['medicine_name']">
                                </div>
                                <div class="form-group col-4">
                                <input type="text" name="med[1]['daily_dose']" class="form-control" id="med[1]['daily_dose']">
                                </div>
                                <div class="form-group col-4">
                                <input type="text" name="med[1]['start_date']"  class="form-control datepicker" id="med[1]['start_date']">
                                </div>
                            </div>
                        </div>
                      </div>
                   
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">   
                      <div class="form-group col-12">
                            <label for="medication_supplement">Current over-the-counter medications or supplements: </label>
                            <textarea name="medication_supplement" class="form-control" id="medication_supplement" rows="3" cols="100">{{ count($patient_past_history) ? $patient_past_history[0]->medication_supplement:'' }}</textarea>
                      </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">   
                      <div class="form-group col-12">
                            <label for="medical_problem">Current medical problems: </label>
                            <textarea name="medical_problem" class="form-control" id="medical_problem" rows="3" cols="100">{{ count($patient_past_history) ? $patient_past_history[0]->medical_problem:'' }}</textarea>
                      </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">   
                      <div class="form-group col-12">
                            <label for="past_medical_problem">Past medical problems, nonpsychiatric hospitalization, or surgeries:  </label>
                            <textarea name="past_medical_problem" class="form-control" id="past_medical_problem" rows="3" cols="100">{{ count($patient_past_history) ? $patient_past_history[0]->past_medical_problem:'' }}</textarea>
                      </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-4 required" >
                          <p for="inputEmail3" class=" col-form-label">Have you ever had an EKG?  </p>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_ekg">
                          <input type="radio" name="ekg" {{ (count($patient_past_history) && $patient_past_history[0]->ekg == 'yes')?'checked=""':'' }} value="yes" onclick="showHideFunction('yes', 'ekg_div')" id="radioDanger_ekg" class="radioinline" >YES
                          <label for="radioDanger_ekg"></label>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_ekg2">
                          <input type="radio" name="ekg" {{ (count($patient_past_history) && $patient_past_history[0]->ekg == 'no')?'checked=""':'' }} value="no" onclick="showHideFunction('no', 'ekg_div')" id="radioDanger_ekg2" class="radioinline" >NO
                          <label for="radioDanger_ekg2"></label>
                        </div>
                      </div>

                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="{{ (count($patient_past_history) && $patient_past_history[0]->ekg == 'yes')?'':'hide' }}" id="ekg_div">
                        <div class="row">
                          <div class="form-group col-6 required" >
                            <input type="text" name="ekg_when" value="{{ count($patient_past_history) ? $patient_past_history[0]->ekg_when:'' }}" class="form-control" id="ekg_when" placeholder="When ?">

                          </div>
                          <div class="form-group col-2 required icheck-danger" style="display:block;" for="checkboxDanger1">
                            <input type="checkbox" {{-- in_array($key, $symtoms_return)?'checked=""':'' --}} name="ekg_type" value="normal" id="checkboxDanger1" class="checkboxinline " >
                            <label for="checkboxDanger1">Normal</label>
                          </div>
                          <div class="form-group col-2 required icheck-danger" style="display:block;" for="checkboxDanger2">
                            <input type="checkbox" {{-- in_array($key, $symtoms_return)?'checked=""':'' --}} name="ekg_type" value="abnormal" id="checkboxDanger2" class="checkboxinline " >
                            <label for="checkboxDanger2">Abnormal</label>
                          </div>
                          <div class="form-group col-2 required icheck-danger" style="display:block;" for="checkboxDanger3">
                            <input type="checkbox" {{-- in_array($key, $symtoms_return)?'checked=""':'' --}} name="ekg_type" value="unknown" id="checkboxDanger3" class="checkboxinline " >
                            <label for="checkboxDanger3">Unknown</label>
                          </div>
                        </div>
                    </div>

                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">For women only:</legend>
                      <div class="row">
                        <div class="form-group col-4 required>
                          <label for="period_date" clas="required">Date of last menstrual period</label>
                            <input type="text" name="women['period_date']" value="{{ count($patient_past_history) ? $patient_past_history[0]->period_date:'' }}" class="form-control datepicker" id="period_date">
                        </div>

                        <div class="form-group col-6 required>
                          <p for="period_date" clas="required">Are you currently pregnant or do you think you might be pregnant?</span></p>
                        </div>

                        <div class="form-group col-1 required icheck-danger" for="radioDanger_pragnent">
                          <input type="radio" name="women['pragnent']" value="yes" id="radioDanger_pragnent" class="radioinline" >YES
                          <label for="radioDanger_pragnent"></label>
                        </div>
                        <div class="form-group col-1 required icheck-danger" for="radioDanger_pragnent2">
                          <input type="radio" name="women['pragnent']" value="no" id="radioDanger_pragnent2" class="radioinline" >NO
                          <label for="radioDanger_pragnent2"></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-6 required>
                          <p for="period_date" clas="required"> Are you planning to get pregnant in the near future?</span></p>
                        </div>

                        <div class="form-group col-1 required icheck-danger" for="radioDanger_future_pragnent">
                          <input type="radio" name="women['future_pragnent']" value="yes" id="radioDanger_future_pragnent" class="radioinline" >YES
                          <label for="radioDanger_future_pragnent"></label>
                        </div>
                        <div class="form-group col-1 required icheck-danger" for="radioDanger_future_pragnent2">
                          <input type="radio" name="women['future_pragnent']" value="no" id="radioDanger_future_pragnent2" class="radioinline" >NO
                          <label for="radioDanger_future_pragnent2"></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-12 required>
                          <label for="period_date" clas="required">Birth control method </label>
                            <input type="text" name="women['birth_control_method']" value="{{ count($patient_past_history) ? $patient_past_history[0]->birth_control_method:'' }}" class="form-control" id="birth_control_method">
                        </div>
                        <div class="form-group col-6 required>
                          <label for="period_date" clas="required">How many times have you been pregnant?   </label>
                            <input type="number" name="women['how_many_time_pragnent']" value="{{ count($patient_past_history) ? $patient_past_history[0]->how_many_time_pragnent:'' }}" class="form-control" id="how_many_time_pragnent">
                        </div>
                        <div class="form-group col-6 required>
                          <label for="period_date" clas="required"> How many live births? </label>
                            <input type="number" name="women['live_birth']" value="{{ count($patient_past_history) ? $patient_past_history[0]->live_birth:'' }}" class="form-control" id="live_birth">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-10 required>
                          <p for="period_date" clas="required"> Do you have any concerns about your physical health that you would like to discuss with us? </span></p>
                        </div>

                        <div class="form-group col-1 required icheck-danger" for="radioDanger_physical_health_discuss">
                          <input type="radio" name="women['physical_health_discuss']" value="yes" id="radioDanger_physical_health_discuss" class="radioinline" >YES
                          <label for="radioDanger_physical_health_discuss"></label>
                        </div>
                        <div class="form-group col-1 required icheck-danger" for="radioDanger_physical_health_discuss2">
                          <input type="radio" name="women['physical_health_discuss']" value="no" id="radioDanger_physical_health_discuss2" class="radioinline" >NO
                          <label for="radioDanger_physical_health_discuss2"></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-4 required>
                          <p for="period_date" clas="required"> Date and place of last physical exam: </span></p>
                        </div>

                        <div class="form-group col-4 required">
                          <input type="text" name="women['last_physical_exam_date']" value="{{ count($patient_past_history) ? $patient_past_history[0]->last_physical_exam_date:'' }}" class="form-control datepicker" id="last_physical_exam_date">
                        </div>
                        <div class="form-group col-4 required">
                          <input type="text" name="women['last_physical_exam_place']" value="{{ count($patient_past_history) ? $patient_past_history[0]->last_physical_exam_place:'' }}" class="form-control" placeholder="Last Physical Exam Place" id="last_physical_exam_place">
                        </div>
                      </div>
                    </fieldset>

                    <?php 
                      $family_medical_history_return =array();
                      $family_medical_history = array('Thyroid Disease','Anemia','Liver Disease','Chronic Fatigue','Kidney Disease',
                                    'Diabetes','Asthma/respiratory problems','Stomach or intestinal problems','Cancer (type)','Fibromyalgia','Heart Disease','Epilepsy or seizures',
                                    'Chronic Pain','High Cholesterol','High blood pressure','Head trauma','Liver problems');

                                  if(count($patient_past_history) && strlen($patient_past_history[0]->family_medical_history)){
                                    $family_medical_history_return = explode(',', $patient_mental_health[0]->family_medical_history);
                                  }
                      
                      ?>

                    <fieldset class="scheduler-border">
                      <legend class="scheduler-border">Personal and Family Medical History:</legend>
                      <div class="row ">
                      @foreach($family_medical_history as $key => $value)
                      <!-- ------------------------------------------------------------------------------------------- -->
                      <div class="col-md-12">
                        <div class="row ">
                          <div class="col-md-4">
                            <p for="inputEmail3" class=" col-form-label">{{ucfirst($value)}}</p>
                          </div>
                          <div class="col-md-2 form-group icheck-danger">
                            <input type="checkbox" name="family_medical_history[{{$key}}]" value="{{$key}}" id="checkboxDanger{{$key}}" class="checkboxinline " >
                            <label for="checkboxDanger{{$key}}">You</label>
                          </div>
                          <div class="col-md-2 form-group icheck-danger">
                            <input type="checkbox" name="family_medical_history[{{$key}}]" value="{{$key}}" id="checkboxDanger{{$key}}" class="checkboxinline " >
                            <label for="checkboxDanger{{$key}}">Family</label>
                          </div>
                          <div class="col-md-4 form-group">
                            <input type="text" name="family_medical_history[{{$key}}]" value="{{$key}}" id="checkboxDanger{{$key}}" class="checkboxinline " >
                            <label for="checkboxDanger{{$key}}">Family</label>
                          </div>
                        </div>
                        </div>
                    @endforeach
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    </fieldset>



                    <!-- ------------------------------------------------------------------------------------------- -->
                      <div class="row" id="mental_health_alert">
                        
                      </div>
                  <!-- ------------------------------------------------------------------------------------------- -->
                
                
                </div>
                <div class="card-footer">
                  <button type="submit" id="submitbutton_mental_health" class="btn btn-danger">Submit</button>
                  <span class="hide" id="loading_mental_health"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>

                </div>
              </form>
            </div>
            <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
            <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

            <script>
            //Date picker
    $('.datepicker').daterangepicker({
      singleDatePicker: true,
    showDropdowns: true,
    minYear: 2000,
    maxYear: parseInt(moment().format('YYYY'),10)
    });
                $('#add_med_list').on('click', add);
                $('#remove_med_list').on('click', remove);
                function remove() {
                  var i = $('#med').children().last().attr('id');
                  var k = parseInt(i);
                  if(k > 1){
                    $('#med #'+k).remove();
                  } 
                }

                function add() {
                  var i = $('#med').children().last().attr('id');
                  var k = parseInt(i) + 1; 
                  var new_input = '<div id="'+k+'" style="width:100%;display:flex;">'+
                                    '<div class="form-group col-4">'+
                                      '<input type="text" name="med['+k+'][medicine_name]" value="" class="form-control" id="med['+k+'][medicine_name]">'+
                                    '</div>'+
                                    '<div class="form-group col-4">'+
                                      '<input type="text" name="med['+k+'][daily_dose]" value="" class="form-control" id="med['+k+'][daily_dose]">'+
                                    '</div>'+
                                    '<div class="form-group col-4">'+
                                      '<input type="text" name="med['+k+'][start_date]" value="" class="form-control datepicker" id="med['+k+'][start_date]">'+
                                    '</div>'+
                                  '</div>';

                  $('#med').append(new_input);
                  $('.datepicker').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 2000,
                    maxYear: parseInt(moment().format('YYYY'),10)
                  });
                }

              function lifeFeeling(value){
                if(value == 'yes'){
                  $('#suicide_risk').show("slow").removeClass('hide');
                }else{
                  $('#suicide_risk').hide("slow").addClass('hide');
                }
                // alert(value);
                return false;

              }

              function showHideFunction(value, id){
                if(value == 'yes'){
                  $('#'+id).show("slow").removeClass('hide');
                }else{
                  $('#'+id).hide("slow").addClass('hide');
                }
                // alert(value);
                return false;

              }

              
              //$('#form2').closest('.form-group').find('label').text();
            </script>

<script type="text/javascript">
$(document).ready(function(){
  
	$('#submitbutton_mental_health').click(function() {
    // alert($("#monday_start_at").val());
  $('#mental_health').validate({
    rules:
     {},
    messages:
     {},
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
        $('#loading_mental_health').removeClass('hide').show();

				var fdata=new FormData(form);
				$.ajax({
					type: "POST",
					url: '{{route("patient.mentalhealthsubmit")}}',
					data: fdata,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result)
					{
            if(result == 1){
              var alert='<div class="col-md-12"><div class="alert alert-success alert-dismissible">'+
                              'Information has been Updated.'+
                            ' </div></div>';
              $('#mental_health_alert').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

            }else{
              var alert='<div class="col-md-12"><div class="alert alert-danger alert-dismissible">'+
                              'Something went wrong.'+
                            ' </div></div>';
              $('#mental_health_alert').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

            }
              $('#loading_mental_health').addClass('hide').hide();
						return false;
					}
				});
				
				return false;
			}
  });
});
});


$("#ekg_div input:checkbox").on('click', function() {
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

<style>
fieldset.scheduler-border {
    border: 1px groove #ced4da !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #ced4da;
            box-shadow:  0px 0px 0px 0px #ced4da;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

            

            
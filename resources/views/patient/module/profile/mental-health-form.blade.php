            
            <?php $patient_mental_health = $CentralController->getPatientMentalHealth( Auth::guard('patient')->user()->id ); //dd($patient_mental_health[0]); ?>
            <div class="card card-danger  card-outline">
                <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Mental Health Intake Form</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <form role="form" action="{{route('patient.mentalhealthsubmit')}}" id="mental_health" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-4 required">
                            <label for="primary_care_physician" clas="required">Primary Care Physician<span class="text-danger">*</span></label>
                            <input type="text" name="primary_care_physician" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->primary_care_physician:'' }}" class="form-control" id="primary_care_physician">
                        </div>
                        <div class="form-group col-4">
                            <label for="current_therapist" clas="required">Current Therapist/Counselor<span class="text-danger">*</span></label>
                            <input type="text" name="current_therapist" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->primary_care_physician:'' }}" class="form-control" id="current_therapist">
                        </div>
                        <div class="form-group col-4">
                            <label for="therapist_phone" clas="required">Therapist's Phone<span class="text-danger">*</span></label>
                            <input type="text" name="therapist_phone" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->therapist_phone:'' }}" class="form-control" id="therapist_phone">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                      <div class="form-group col-10 required" >
                        <label>Do you give permission for ongoing regular updates to be provided to your primary care physician</label>
                      </div>
                      <div class="form-group col-2 required icheck-danger" for="checkboxDanger">
                        <input type="checkbox" name="permission" {{ (count($patient_mental_health) && $patient_mental_health[0]->permission == 1) ? 'checked=checked':'' }} id="checkboxDanger" class="checkboxinline" >
                        <label for="checkboxDanger"></label>
                      </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->

                    <div class="row">   
                      <div class="form-group col-12">
                            <label for="problem">What are the problem(s) for which you are seeking help?</label>
                            <textarea name="problem" class="ckeditor form-control" id="problem" rows="3" cols="100">{{ count($patient_mental_health) ? $patient_mental_health[0]->problem:'' }}</textarea>
                      </div>
                    </div>
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">   
                      <div class="form-group col-12">
                            <label for="treatment_goal">What are your treatment goals?</label>
                            <textarea name="treatment_goal" class="ckeditor form-control" id="treatment_goal" rows="3" cols="100">{{ count($patient_mental_health) ? $patient_mental_health[0]->treatment_goal:'' }}</textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-10 required" >
                        <label>Current Symptoms Checklist: (check once for any symptoms present, twice for major symptoms)</label>
                      </div>
                    </div>

                    <!-- ------------------------------------------------------------------------------------------- -->
                    <?php 
                      $symtoms_return =array();
                      $symtoms = array('Depressed mood','Unable to enjoy activities','Sleep pattern disturbance','Loss of interest','Concentration/forgetfulness',
                                    'Change in appetite','Excessive guilt','Fatigue','Decreased libido','Racing thoughts','Impulsivity','Increase risky behavior',
                                    'Increased libido','Decrease need for sleep','Excessive energy','Increased irritability','Crying spells','Excessive worry',
                                  'Anxiety attacks','Avoidance','Hallucinations','Suspiciousness');

                                  if(count($patient_mental_health) && strlen($patient_mental_health[0]->symtoms)){
                                    $symtoms_return = explode(',', $patient_mental_health[0]->symtoms);
                                  }
                      
                      ?>

                    <div class="row ">
                      @foreach($symtoms as $key => $value)
                    <!-- ------------------------------------------------------------------------------------------- -->
                      <div class="col-md-6">
                        <div class="row ">
                          <div class="col-md-6">
                            <p for="inputEmail3" class=" col-form-label">{{ucfirst($value)}}</p>
                          </div>
                          <div class="col-md-2 form-group icheck-danger">
                            <input type="checkbox" {{ in_array($key, $symtoms_return)?'checked=""':'' }} name="symtoms[{{$key}}]" value="{{$key}}" id="checkboxDanger{{$key}}" class="checkboxinline " >
                            <label for="checkboxDanger{{$key}}"></label>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="row">
                      <div class="form-group col-12 required" >
                        <label>Suicide Risk Assessment </label>
                      </div>

                      <div class="form-group col-8 required" >
                        <p for="inputEmail3" class=" col-form-label">Have you ever had feelings or thoughts that you didn't want to live? </p>
                      </div>
                      <div class="form-group col-2 required icheck-danger" for="radioDanger_risk1">
                        <input type="radio" name="life_feeling" value="yes" {{ (count($patient_mental_health) && $patient_mental_health[0]->life_feeling == 'yes')?'checked':'' }} onclick="lifeFeeling('yes')" id="radioDanger_risk1" class="radioinline" >YES
                        <label for="radioDanger_risk1"></label>
                      </div>
                      <div class="form-group col-2 required icheck-danger" for="radioDanger_risk2">
                        <input type="radio" name="life_feeling" value="no" {{ (count($patient_mental_health) && $patient_mental_health[0]->life_feeling == 'no')?'checked':'' }} onclick="lifeFeeling('no')" id="radioDanger_risk2" class="radioinline" >NO
                        <label for="radioDanger_risk2"></label>
                      </div>
                    </div>
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="{{ (count($patient_mental_health) && $patient_mental_health[0]->life_feeling == 'yes')?'':'hide' }}" id="suicide_risk">
                      <div class="row">

                        <div class="form-group col-8 required" >
                          <p for="inputEmail3" class=" col-form-label">Do you <b>currently</b> feel that you don't want to live? </p>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_risk3">
                          <input type="radio" name="currently_life_feeling" {{ (count($patient_mental_health) && $patient_mental_health[0]->currently_life_feeling == 'yes')?'checked':'' }} value="yes" onclick="lifeFeeling('yes')" id="radioDanger_risk3" class="radioinline" >YES
                          <label for="radioDanger_risk3"></label>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_risk4">
                          <input type="radio" name="currently_life_feeling" {{ (count($patient_mental_health) && $patient_mental_health[0]->currently_life_feeling == 'no')?'checked':'' }} value="no" onclick="lifeFeeling('no')" id="radioDanger_risk4" class="radioinline" >NO
                          <label for="radioDanger_risk4"></label>
                        </div>
                      </div>
                    
                    
                    <!-- ------------------------------------------------------------------------------------------- -->

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="thoughts" clas="required">How often do you have these thoughts?</label>
                              <input type="text" name="thoughts" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->thoughts:'' }}" class="form-control" id="thoughts">
                          </div>
                      </div>
                    <!-- ------------------------------------------------------------------------------------------- -->

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="last_time_dying_thoughts" clas="required">When was the last time you had thoughts of dying?</label>
                              <input type="text" name="last_time_dying_thoughts" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->last_time_dying_thoughts:'' }}" class="form-control" id="last_time_dying_thoughts">
                          </div>
                      </div>

                    <!-- ------------------------------------------------------------------------------------------- -->

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="recent_feel" clas="required">Has anything happened recently to make you feel this way? </label>
                              <input type="text" name="recent_feel" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->recent_feel:'' }}" class="form-control" id="recent_feel">
                          </div>
                      </div>

                    <!-- ------------------------------------------------------------------------------------------- -->

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="feel_scale" clas="required">On a scale of 1 to 10, (ten being strongest) how strong is your desire to kill yourself currently?  </label>
                              <input type="number" min="1" max="10" name="feel_scale" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->feel_scale:'' }}" class="form-control" id="feel_scale">
                          </div>
                      </div>

                    <!-- ------------------------------------------------------------------------------------------- -->

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="make_better" clas="required"> Would anything make it better?  </label>
                              <input type="text" name="make_better" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->make_better:'' }}" class="form-control" id="make_better">
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="kill_yourself" clas="required"> Have you ever thought about how you would kill yourself?   </label>
                              <input type="text" name="kill_yourself" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->kill_yourself:'' }}" class="form-control" id="kill_yourself">
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="readily_available" clas="required"> Is the method you would use readily available?   </label>
                              <input type="text" name="readily_available" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->readily_available:'' }}" class="form-control" id="readily_available">
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="planned_time" clas="required"> Have you planned a time for this?   </label>
                              <input type="text" name="planned_time" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->planned_time:'' }}" class="form-control" id="planned_time">
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="stop_killing" clas="required"> Is there anything that would stop you from killing yourself?   </label>
                              <input type="text" name="stop_killing" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->stop_killing:'' }}" class="form-control" id="stop_killing">
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="hopeless" clas="required"> Do you feel hopeless and/or worthless?    </label>
                              <input type="text" name="hopeless" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->hopeless:'' }}" class="form-control" id="hopeless">
                          </div>
                      </div>

                      <div class="row">
                          <div class="form-group col-12">
                              <label for="tried_kill_or_harm" clas="required"> Have you ever tried to kill or harm yourself before?    </label>
                              <input type="text" name="tried_kill_or_harm" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->tried_kill_or_harm:'' }}" class="form-control" id="tried_kill_or_harm">
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-8 required" >
                          <p for="inputEmail3" class=" col-form-label">Do you have access to guns?  </p>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_access_gun">
                          <input type="radio" name="access_gun" {{ (count($patient_mental_health) && $patient_mental_health[0]->access_gun == 'yes')?'checked=""':'' }} value="yes" onclick="accessGun('yes')" id="radioDanger_access_gun" class="radioinline" >YES
                          <label for="radioDanger_access_gun"></label>
                        </div>
                        <div class="form-group col-2 required icheck-danger" for="radioDanger_access_gun2">
                          <input type="radio" name="access_gun" {{ (count($patient_mental_health) && $patient_mental_health[0]->access_gun == 'no')?'checked=""':'' }} value="no" onclick="accessGun('no')" id="radioDanger_access_gun2" class="radioinline" >NO
                          <label for="radioDanger_access_gun2"></label>
                        </div>
                      </div>

                      <div class="{{ (count($patient_mental_health) && $patient_mental_health[0]->access_gun == 'yes')?'':'hide' }}" id="access_gun">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="access_gun_explain" clas="required"> Please explain.</label>
                                <input type="text" name="access_gun_explain" value="{{ count($patient_mental_health) ? $patient_mental_health[0]->access_gun_explain:'' }}" class="form-control" id="access_gun_explain">
                            </div>
                        </div>
                      </div>
                    </div>


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

            <script>
              function lifeFeeling(value){
                if(value == 'yes'){
                  $('#suicide_risk').show("slow").removeClass('hide');
                }else{
                  $('#suicide_risk').hide("slow").addClass('hide');
                }
                // alert(value);
                return false;

              }

              function accessGun(value){
                if(value == 'yes'){
                  $('#access_gun').show("slow").removeClass('hide');
                }else{
                  $('#access_gun').hide("slow").addClass('hide');
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





</script>

            

            
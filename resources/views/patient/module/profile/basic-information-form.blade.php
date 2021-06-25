
            <div class="card card-danger  card-outline">
                <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title">Basic Information</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                {{--dd(Auth::guard('patient')->user())--}}
                <form role="form" id="form" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-4 required">
                            <label for="name" clas="required">Full Name<span class="text-danger">*</span></label>
                            <input type="text" {{strlen(Auth::guard('patient')->user()->name)?"disabled=disabled":''}} name="name" value="{{Auth::guard('patient')->user()->name}}" class="form-control" id="name" placeholder="Full Name">
                        </div>
                        <div class="form-group col-4 required">
                            <label for="middle_name" clas="required">Middle Initial</label>
                            <input type="text" {{strlen(Auth::guard('patient')->user()->middle_name)?"disabled=disabled":''}} name="middle_name" value="{{Auth::guard('patient')->user()->middle_name}}" class="form-control" id="middle_name" placeholder="MIDDLE INITIAL">
                        </div>
                        <div class="form-group col-4 required">
                            <label for="last_name" clas="required">Last Name</label>
                            <input type="text" {{strlen(Auth::guard('patient')->user()->last_name)?"disabled=disabled":''}} name="last_name" value="{{Auth::guard('patient')->user()->last_name}}" class="form-control" id="last_name" placeholder="Last INITIAL">
                        </div>
                        <div class="form-group col-12">
                            <label for="email" clas="required">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" {{strlen(Auth::guard('patient')->user()->email)?"disabled=disabled":''}} value="{{Auth::guard('patient')->user()->email}}" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                    {{--dd($CentralController::getCountryById(1))--}}
                        <div class="form-group col-6" data-select2-id="48">
                            <label clas="required">Country</label>
                            <select class="form-control select2" id="country" name="country" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            @foreach($country as $key => $value)  
                                <option value="{{$value['id']}}">{{$value['title']}}</option>
                            @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>State</label>
                            <select class="form-control select2" name="state" data-dropdown-css-class="select2-danger" id="state" style="width: 100%;">
                            @if(!is_null(Auth::guard('patient')->user()->state))
                              @php
                                $state = $CentralController->getStateById(Auth::guard('patient')->user()->country);
                              @endphp
                              @foreach($state as $key => $value)  
                                  <option value="{{$value['id']}}">{{$value['title']}}</option>
                              @endforeach
                            @endif    
                            </select>
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-12 required">
                            <label for="address" clas="required">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" value="{{Auth::guard('patient')->user()->address}}" class="form-control" id="address" placeholder="Full Address">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Date OF Birth</label>
                            <input type="text" class="form-control" name="dob" data-inputmask-alias="datetime" value="{{ date('d/m/Y', strtotime(Auth::guard('patient')->user()->dob)) }}" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                        </div>
                        <?php $depart_id_value = array(); ?>
                        @if(!is_null(Auth::guard('patient')->user()->depart_id))
                            <?php $depart_id_value = explode(",",Auth::guard('patient')->user()->depart_id); ?>
                        @endif
                        <div class="form-group col-6 select2-danger ">
                            <label clas="required">Related Depart<span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-danger" name="depart_id[]" id="depart" multiple="multiple" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                @foreach($specilitization as $key => $value)
                                    <option {{ in_array($value['id'], $depart_id_value)?'selected=selected':'' }} value="{{$value['id']}}">{{$value['title']}}</option>
                                @endforeach 
                            </select>
                        </div>
                        
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control custom-file-input" id="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="contact_no" clas="required">Contact No.<span class="text-danger">*</span></label>
                            <input type="text" name="contact_no" value="{{ Auth::guard('patient')->user()->contact_no }}" class="form-control" id="contact_no" placeholder="Contact Number">
                        </div>
                        
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                      <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-success alert-dismissible hide" id="success-alert">
                            Your Information has been Updated.
                          </div>
                        </div>
                      </div>
                  <!-- ------------------------------------------------------------------------------------------- -->
                
                </div>
                <div class="card-footer">
                  <button type="submit" id="submitbutton" name="submit" class="btn btn-danger">Submit</button>
                  <span class="hide" id="loading1"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>
                </div>
              </form>
            </div>



<script type="text/javascript">
$(document).ready(function(){
	$('#submitbutton').click(function() {
 			$("#form").validate({
        rules:{
        country: {required: true},
        address: {required: true},
        depart: {required: true},
        contact_no: {required: true},
        dob: {required: true},  
        image: {extension: "jpg|jpeg|png|JPG|JPEG|PNG"},
      },

      messages: {
        image: {extension: "File Formate Invalid"},
        address: "Address Field Required",
        country: "Please Select a Country",
        dob: "Please Enter Your Date of Birth",
        depart: "Please Select Depart",
        contact_no: "Please Enter your Contact Number",
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
        $('#loading1').removeClass('hide').show();

				var fdata=new FormData(form);
				$.ajax({
					type: "POST",
					url: '{{route("patient.profilesubmit")}}',
					data: fdata,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result)
					{
            if(result == 1){
              $('#loading1').addClass('hide').hide();
              $('#success-alert').removeClass('hide').show().slideDown(500).delay(2500).slideUp(500);

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


 
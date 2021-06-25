<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Your Basic Information <small></small></h3>
              </div>
              {{--dd(Auth::guard('doctor')->user())--}}
              <form role="form" id="form" novalidate="novalidate">
                <div class="card-body">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-4 required">
                            <label for="name" clas="required">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" {{strlen(Auth::guard('doctor')->user()->name)?"disabled=disabled":''}} value="{{Auth::guard('doctor')->user()->name}}" class="form-control" id="name" placeholder="Full Name">
                        </div>
                        <div class="form-group col-4 required">
                            <label for="middle_name" clas="required">Middle Name</label>
                            <input type="text" name="middle_name" {{strlen(Auth::guard('doctor')->user()->middle_name)?"disabled=disabled":''}} value="{{Auth::guard('doctor')->user()->middle_name}}" class="form-control" id="middle_name" placeholder="Middle Name">
                        </div>
                        <div class="form-group col-4 required">
                            <label for="last_name" clas="required">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="last_name" {{strlen(Auth::guard('doctor')->user()->last_name)?"disabled=disabled":''}} value="{{Auth::guard('doctor')->user()->last_name}}" class="form-control" id="last_name" placeholder="Last Name">
                        </div>
                        <div class="form-group col-6">
                            <label for="email" clas="required">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" {{strlen(Auth::guard('doctor')->user()->email)?"disabled=disabled":''}} value="{{Auth::guard('doctor')->user()->email}}" class="form-control" id="email" placeholder="Email">
                        </div>
                        <?php $specialization_id_value=array(); ?>
                        @if(!is_null(Auth::guard('doctor')->user()->specialization_id))
                          <?php $specialization_id_value = explode(",",Auth::guard('doctor')->user()->specialization_id); ?>
                        @endif

                        <div class="form-group col-6 select2-danger">
                            <label clas="required">Specialization<span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-danger" name="specialization_id[]" data-dropdown-css-class="select2-danger" id="specialization" multiple="multiple" style="width: 100%;">
                                @foreach($specilitization as $key => $value)
                                    <option {{ in_array($value['id'], $specialization_id_value)?'selected=selected':'' }} value="{{$value['id']}}">{{$value['title']}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                    {{--dd($CentralController::getCountryById(1))--}}
                        <div class="form-group col-6" data-select2-id="48">
                            <label clas="required">Country</label>
                            <select class="form-control select2-danger" id="country" name="country" data-dropdown-css-class="select2-danger"  style="width: 100%;">
                            @foreach($country as $key => $value)  
                                <option value="{{$value['id']}}">{{$value['title']}}</option>
                            @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>State</label>
                            <select class="form-control select2 select2-danger" name="state" id="state" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            @if(!is_null(Auth::guard('doctor')->user()->state))
                              @php
                                $state = $CentralController->getStateById(Auth::guard('doctor')->user()->country);
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
                            <input type="text" name="address" value="{{Auth::guard('doctor')->user()->address}}" class="form-control" id="address" placeholder="Full Address">
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="form-group col-6">
                            <label for="experience" clas="required">Experience<span class="text-danger">*</span></label>
                            <input type="number" name="experience" value="{{Auth::guard('doctor')->user()->experience}}" class="form-control" id="experience" placeholder="Experience">
                        </div>
                        <div class="form-group col-6">
                            <label for="current_job" clas="required">Current Job<span class="text-danger">*</span></label>
                            <input type="text" name="current_job" value="{{ Auth::guard('doctor')->user()->current_job }}" class="form-control" id="current_job" placeholder="Current Job">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    
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
                            <input type="text" name="contact_no" value="{{ Auth::guard('doctor')->user()->contact_no }}" class="form-control" id="contact_no" placeholder="Contact Number">
                        </div>
                        <div class="form-group col-12">
                            <label for="note">Short Description (optional) <small><i>education, experience<i></small></label>
                            <textarea name="note" class="ckeditor @error('note') is-invalid @enderror" id="note" placeholder="Place some text here" rows="10" cols="80">{{ Auth::guard('doctor')->user()->note }}</textarea>
                        </div>
                        
                    </div>
                    
                    <!-- ----------------------------------------------------Alert---------------------------------- -->
                    <div class="row hide"  id="form-alert">
                        
                          
                       
                      </div>
                    
                    
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                  
                </div>
                <div class="card-footer">
                  <button type="submit" id="submitbutton" name="submit" class="btn btn-danger">Submit</button>
                  <span class="hide" id="loading1"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>
                </div>
              </form>
            </div>
            </div>
          <div class="col-md-6">
          </div>
        </div>
      </div>
    </section>


<script type="text/javascript">

$(document).ready(function(){
	$('#submitbutton').click(function() {
  $('#form').validate({
    rules:
     {email: {required: true,email: true,},
     country: {required: true},
     experince: {required: true},
     specialization: {required: true},
     current_job: {required: true},
     contact_no: {required: true},
      image: {extension: "jpg|jpeg|png|JPG|JPEG|PNG"},
    },
    messages:
     {email: {required: "Please enter a email address",email: "Please enter a vaild email address"},
     country: "Please Select a Country",
     experince: "Please Enter Your professional Experince",
     specialization: "Please Select Specialization",
     current_job: "Please Enter you Current Job",
     contact_no: "Please Enter your Contact Number",
     image: {extension: "File Formate Invalid"},
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
					url: '{{route("doctor.profilesubmit")}}',
					data: fdata,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result)
					{
            if(result == 1){
              var alert='<div class="col-md-12"><div class="alert alert-success alert-dismissible">'+
                              'Your Information has been Updated.'+
                            ' </div></div>';
              $('#loading1').addClass('hide').hide();
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

	
$(function () {

    @if(!is_null(Auth::guard('doctor')->user()->country))
      var country_value = "{{Auth::guard('doctor')->user()->country}}";
    @else
      var country_value = null;
    @endif
    $('#country').select2({
        placeholder: "Select a Country",
    }).val(country_value).trigger('change');

    $('#country').on('change', function() {
      var id = $("#country option:selected").val();

            $.ajax({
                type: "post",
                url: "{{ route('getstate') }}",
                data: {_method: 'POST','id':id},
                cache: false,
                success: function(data){
                    // console.log(data);
                    if (!data.length) {
                        // console.log(data);
                        $("#state").html("");
                        // $('#state').select2('data', null);
                        return false;
                    }
                    $option = "";
                    $("#state").html("");
                    $.each(data, function(index, item) {
                        $('#state').append('<option value="'+item.id+'">'+item.title+'</option>');
                    });
                    return false;
                }
            });
    });

    @if(!is_null(Auth::guard('doctor')->user()->state))
      var state_value = "{{Auth::guard('doctor')->user()->state}}";
    @else
      var state_value = null;
    @endif

    $('#state').select2({
        placeholder: "Select a state",
        allowClear: false
    }).val(state_value).trigger('change');



    $('#state').on('change', function() {
      var id = $("#state option:selected").val();

            $.ajax({
                type: "post",
                url: "{{ route('getcity') }}",
                data: {_method: 'POST','id':id},
                cache: false,
                success: function(data){
                    if (!data.length) {
                        $("#city").html("");
                        // $('#city').select2('data', null);
                        return false;
                    }
                    $("#city").html("");
                    $.each(data, function(index, item) {
                        $('#city').append('<option value="'+item.id+'">'+item.title+'</option>');
                    });
                    return false;
                }
            });
    });

    @if(!is_null(Auth::guard('doctor')->user()->city))
      var city_value = "{{Auth::guard('doctor')->user()->city}}";
    @else
      var city_value = null;
    @endif

    $('#city').select2({
        placeholder: "Select a state",
        allowClear: false
    }).val(city_value).trigger('change');

    

    $('#specialization').select2({
        placeholder: "Select Specialization",
        allowClear: true
    });

});
        
$('#image').on('change',function(){
                //get the file name
    var fileName = $(this).val().split("\\");
    // alert(fileName[0]);
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName[2]);

});

</script>


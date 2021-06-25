
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
                <form role="form" id="form" class="form-horizontal" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                    
                    <div class="row">
                        <div class="form-group col-6 required">
                            <label for="name" clas="required">Full Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{Auth::guard('doctor')->user()->name}}" class="form-control" id="name" placeholder="Full Name">
                        </div>
                        <div class="form-group col-6">
                            <label for="email" clas="required">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{Auth::guard('doctor')->user()->email}}" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                    {{--dd($CentralController::getCountryById(1))--}}
                        <div class="form-group col-6" data-select2-id="48">
                            <label clas="required">Country</label>
                            <select class="form-control select2" id="country" name="country" style="width: 100%;">
                            @foreach($country as $key => $value)  
                                <option value="{{$value['id']}}">{{$value['title']}}</option>
                            @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>State</label>
                            <select class="form-control select2" name="state" id="state" style="width: 100%;">
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
                        
                        <div class="form-group col-6" data-select2-id="48">
                            <label>City</label>
                            <select class="form-control select2" name="city" id="city" style="width: 100%;">
                            @if(!is_null(Auth::guard('doctor')->user()->city))
                              @php
                                $city = $CentralController->getCityById(Auth::guard('doctor')->user()->state);
                              @endphp
                              @foreach($city as $key => $value)  
                                  <option value="{{$value['id']}}">{{$value['title']}}</option>
                              @endforeach
                            @endif 
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="experince" clas="required">Experince<span class="text-danger">*</span></label>
                            <input type="number" name="experince" value="{{Auth::guard('doctor')->user()->experince}}" class="form-control" id="experince" placeholder="Experince">
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    {{--dd($specilitization)--}}
                    <?php $specialization_id_value=array(); ?>
                    @if(!is_null(Auth::guard('doctor')->user()->specialization_id))
                        <?php $specialization_id_value = explode(",",Auth::guard('doctor')->user()->specialization_id); ?>
                    @endif
                    <div class="row">
                        <div class="form-group col-6 select2-purple">
                            <label clas="required">Specialization<span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-purple" name="specialization_id[]" id="specialization" multiple="multiple" style="width: 100%;">
                                @foreach($specilitization as $key => $value)
                                    <option {{ in_array($value['id'], $specialization_id_value)?'selected=selected':'' }} value="{{$value['id']}}">{{$value['title']}}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="current_job" clas="required">Current Job<span class="text-danger">*</span></label>
                            <input type="text" name="current_job" value="{{ Auth::guard('doctor')->user()->current_job }}" class="form-control" id="current_job" placeholder="Current Job">
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
                            <input type="text" name="contact_no" value="{{ Auth::guard('doctor')->user()->contact_no }}" class="form-control" id="contact_no" placeholder="Contact Number">
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
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

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
                    console.log(data);
                    if (!data.length) {
                        console.log(data);
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

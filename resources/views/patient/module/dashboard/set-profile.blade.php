<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Your Profile <small></small></h3>
              </div>
              {{--dd(Auth::guard('doctor')->user())--}}
              <form role="form" action="{{route('doctor.profilesubmit')}}" id="form" novalidate="novalidate">
                <div class="card-body">
                    <!-- ------------------------------------------------------------------------------------------- -->
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
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
        $( "#target" ).submit();
    }
  });
  $('#doctorprofile').validate({rules:
     {email: {required: true,email: true,},
     country: {required: true},
     experince: {required: true},
     specialization: {required: true},
     current_job: {required: true},
     contact_no: {required: true},
      image: {required: true, extension: "jpg|jpeg|png|JPG|JPEG|PNG"},
    },
    messages: {email: {required: "Please enter a email address",email: "Please enter a vaild email address"},
      password: {required: "Please provide a password",minlength: "Your password must be at least 5 characters long"},
      image: {required: "Please provide a file", extension: "File Formate Invalid"},
      country: "Please Select a Country",
      experince: "Please Enter Your professional Experince",
      specialization: "Please Select Specialization",
      current_job: "Please Enter you Current Job",
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
    }
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


<style>
.form-group.required .control-label:after { 
   content:"*";
   color:red;
}
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single { border: 1px solid #d2d6de; border-radius: .25rem; padding: 6px 12px; height: 34px; } .select2-container .select2-selection--single .select2-selection__rendered { padding-right: 10px; } .select2-container .select2-selection--single .select2-selection__rendered { padding-left: 0; } .select2-container--default .select2-selection--single .select2-selection__arrow b { margin-top: 0; } .select2-container--default .select2-selection--single .select2-selection__arrow { height: 28px; right: 3px; } </style>
@extends('layouts.app')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('doctor.module.profile.mini-profile')
                @include('doctor.module.profile.aboutme')
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                {{--@include('doctor.module.profile.calender')--}}
                @include('doctor.module.profile.basic-information-form')
                @include('doctor.module.profile.doctor-avalibility-form')
                
          </div>
        </div>
      </div>
    </section>
    
    <link rel="stylesheet" href="{{ asset('assets/plugins/timepiker/jquery.timepicker.min.css') }}">


    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/plugins/timepiker/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ckeditor_4/ckeditor.js') }}"></script>
    <script type="text/javascript">

$(document).ready(function(){
  //CKEDITOR.replace( 'note' );
  //config.width = '50%';

    $('input.timepicker').timepicker({ 'timeFormat': 'h:i A' });
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
<style>
  .form-group.required .control-label:after { 
    content:"*";
    color:red;
  }
  .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single { border: 1px solid #d2d6de; border-radius: .25rem; padding: 6px 12px; height: 34px; } .select2-container .select2-selection--single .select2-selection__rendered { padding-right: 10px; } .select2-container .select2-selection--single .select2-selection__rendered { padding-left: 0; } .select2-container--default .select2-selection--single .select2-selection__arrow b { margin-top: 0; } .select2-container--default .select2-selection--single .select2-selection__arrow { height: 28px; right: 3px; } </style>
  </style>

@endsection
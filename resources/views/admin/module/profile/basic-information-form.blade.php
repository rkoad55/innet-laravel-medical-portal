<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Your Basic Information <small></small></h3>
              </div>
              {{--dd(Auth::guard('admin')->user())--}}
              <form role="form" id="form" novalidate="novalidate">
                <div class="card-body"> 
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                        <div class="form-group col-4 required">
                            <label for="name" clas="required">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" {{strlen(Auth::guard('admin')->user()->name)?"disabled=disabled":''}} value="{{Auth::guard('admin')->user()->name}}" class="form-control" id="name" placeholder="Full Name">
                        </div>
                        <div class="form-group col-4 required">
                            <label for="middle_name" clas="required">Middle Name</label>
                            <input type="text" name="middle_name" {{strlen(Auth::guard('admin')->user()->middle_name)?"disabled=disabled":''}} value="{{Auth::guard('admin')->user()->middle_name}}" class="form-control" id="middle_name" placeholder="Middle Name">
                        </div>
                        <div class="form-group col-4 required">
                            <label for="last_name" clas="required">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="last_name" {{strlen(Auth::guard('admin')->user()->last_name)?"disabled=disabled":''}} value="{{Auth::guard('admin')->user()->last_name}}" class="form-control" id="last_name" placeholder="Last Name">
                        </div>
                       
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
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
                              
                            @if(!is_null(Auth::guard('admin')->user()->state))
                              @php
                                $state = $CentralController->getStateById(Auth::guard('admin')->user()->country);
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
                            <input type="text" name="address" value="{{Auth::guard('admin')->user()->address}}" class="form-control" id="address" placeholder="Full Address">
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
                            <input type="text" name="contact_no" value="{{ Auth::guard('admin')->user()->contact_no }}" class="form-control" id="contact_no" placeholder="Contact Number">
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
     {
     country: {required: true},
     contact_no: {required: true},
      image: {extension: "jpg|jpeg|png|JPG|JPEG|PNG"},
    },
    messages:
     {
     country: "Please Select a Country",
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
					url: '{{route("admin.profilesubmit")}}',
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

	

     
$('#image').on('change',function(){
                //get the file name
    var fileName = $(this).val().split("\\");
    // alert(fileName[0]);
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName[2]);

});

</script>


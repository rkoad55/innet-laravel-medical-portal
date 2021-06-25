<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Password Reset <small></small></h3>
              </div>
              {{--dd(Auth::guard('admin')->user())--}}
              <form role="form" id="form-reset" class="form-horizontal" novalidate="novalidate">
                <div class="card-body">
                   
                   
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                    <div class="form-group row">
                      <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                      <div class="col-sm-6">
                      <input type="old_password" name="old_password" class="form-control" id="old_password" placeholder="Password">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-4 col-form-label">New Password Confirm</label>
                    <div class="col-sm-6">
                      <input type="password_confirmation" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirmation">
                    </div>
                  </div>
                    
                    <!-- ----------------------------------------------------Alert---------------------------------- -->
                    <div class="row hide"  id="form-alert-reset">
                        
                          
                       
                      </div>
                    
                    
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                  
                </div>
                <div class="card-footer">
                  <button type="submit" id="submitbutton-reset" name="submit" class="btn btn-danger">Submit</button>
                  <span class="hide" id="loading1-reset"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>
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
	$('#submitbutton-reset').click(function() {
    // alert(123);
  $('#form-reset').validate({
    rules:
     {
      old_password: {required: true},
      password: {minlength: 5},
      password_confirmation: {minlength: 5, equalTo: "#password"}
    },
    messages:
     {
      password: "Please Select a Country",
      password_confirmation: "Password Confirmation Does Not Match"
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
        $('#loading1-reset').removeClass('hide').show();

				var fdata=new FormData(form);
				$.ajax({
					type: "POST",
					url: '{{route("admin.passwordreset")}}',
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
              $('#loading1-reset').addClass('hide').hide();
              $('#form-alert-reset').removeClass('hide').html(alert).show().slideDown(500).delay(2500).slideUp(500);

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


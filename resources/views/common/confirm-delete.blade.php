<div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title center" id="frm_title">Delete</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body" id="frm_body"></div>
      <div class="modal-footer">
        <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right" id="frm_submit" data-token="{{ csrf_token() }}">Yes</button>
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
    $(function () {
        $('.formConfirm').on('click', function(e) {
              
            e.preventDefault();
            var el = $(this);
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');

            $('#formConfirm')
            .find('#frm_body').html(msg)
            .end().find('#frm_title').html(title)
            .end().modal('show');

            $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
        });

        $('#formConfirm').on('click', '#frm_submit', function(e) {
            var id_arr = $(this).attr('data-form').split('-');
            var id = id_arr[1];
            var page = id_arr[2];
            var dtable_id = id_arr[3];
            var page_url = '{{ url('/admin') }}'+'/'+page+'/'+id;
            // alert(page_url);return false;
            var token = $(this).data('token');
             $.ajax({
                    url: page_url,
                    type: 'post',
                    data: {_method: 'delete', _token :token},
                    
                    success: function( msg ) {
                        // console.log(msg);
                        if(msg ==1){
                            
                            $("#formConfirm .close").click();
                            $('#'+dtable_id+id).addClass('alert-error');
                            setTimeout(function(){
                                $('#'+dtable_id+id).remove().fadeOut();
                                $('#msg').removeClass('hide').html('Record has been deleted successfully').addClass('alert-success');
                            }, 2000);
                            $("#msg").slideDown().delay(2000).slideUp();
                            
                            //$('#msg').html('').removeClass('alert-success').removeClass('alert-warning').fadeIn(2000);

                        }else{
                            $('#msg').removeClass('hide').html('Something went wrong, please try again!').removeClass('alert-success').addClass('alert-warning');
                            $("#formConfirm .close").click();
                            $("#msg").slideDown().delay(2000).slideUp();
                        }

                        $('#msg').addClass('hide');                        
                    },
                    error: function( data ) {
                        if ( data.status === 422 ) {
                            toastr.error('Cannot delete!');
                        }
                    }
                });


            
        });
    });
    
   
</script>
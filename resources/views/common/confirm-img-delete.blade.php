<div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="frm_title">Delete</h4>
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
            //alert(id_arr);return false;
            var main_id = id_arr[1];
            var controller = id_arr[2];
            var method = id_arr[3];
            var image_src_id = id_arr[4];
            var fileinput_show =  id_arr[5];
            var anchor_delete =  id_arr[6];
            //set route url
            var page_url = '{{ url("/admin") }}'+'/'+controller+'/'+method+'/'+main_id+'/'+image_src_id;
            // alert(page_url);return false;
            var token = $(this).data('token');
            
             $.ajax({
                    url: page_url,
                    type: 'post',
                    data: {_method: 'delete', _token :token},
                    
                    success: function( msg ) {
                        if(msg ==1){                            
                            $('#'+image_src_id).remove();
                            $('#'+anchor_delete).remove();
                            $('#'+fileinput_show).removeClass('hide');
                            $("#formConfirm .close").click();
                            setTimeout(function(){
                                $('#'+anchor_delete).remove().fadeOut();
                                $('#delmsg').removeClass('hide').html('Image has been deleted successfully').addClass('alert-success');
                            }, 1000);
                            $("#delmsg").slideDown().delay(2000).slideUp();
                             
                        }else{
                            $('#delmsg').removeClass('hide').html('Something went wrong, please try again!').removeClass('alert-success').addClass('alert-warning');
                            $("#formConfirm .close").click();
                        }
                        $('#delmsg').addClass('hide');
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
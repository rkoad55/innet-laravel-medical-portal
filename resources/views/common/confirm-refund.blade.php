<div class="modal fade" id="formRefund" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title center" id="frm_title">Delete</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body" id="frm_body">
      <div class="row">
        <div class="form-group col-md-6">
            <label for="amount">Amount<span class="red-star">*</span></label>
            <input type="text" disabled name="amount" value="" class="" id="amount" placeholder=" Total Amount">
            
        </div>
        <div class="form-group col-md-6">
            <label for="refund_amount" class="refund_amount_error">Refund Amount<span class="red-star">*</span></label>

            <input type="text" name="refund_amount" value="" class="form-control" id="refund_amount" placeholder="Enter Refund Amount">
            <small id="refund_amountHelp" class="refund_amount_error hide">
            </small> 
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right" id="frm_submit" data-token="{{ csrf_token() }}">Yes</button>
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
    $(function () {
        $('.formRefund').on('click', function(e) {

            $('#amount').val('');
            $('#refund_amount').val('');
            $('#refund_amount').removeClass('is-invalid');
            $('.refund_amount_error').removeClass('text-danger');
            $('#refund_amountHelp').text('').addClass('hide').hide();

            e.preventDefault();
            var el = $(this);
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');
            var id_arr = $(this).attr('data-form').split('-');
            // alert(id_arr[2]);return false;
            $('#amount').val(id_arr[2]);

            $('#formRefund')
            // .find('#frm_body').html(msg)
            .find('#frm_body')
            .end().find('#frm_title').html(title)
            .end().modal('show');

            $('#formRefund').find('#frm_submit').attr('data-form', dataForm);
        });

        $('#formRefund').on('click', '#frm_submit', function(e) {
          e.preventDefault();
          // value->transaction_id-$value->amount-payment-row_
            var id_arr = $(this).attr('data-form').split('-');
            var id = id_arr[1];
            var amount = id_arr[2];
            var page = id_arr[3];
            var dtable_id = id_arr[4];
            var page_url = '{{ url('/admin') }}'+'/'+page+'/'+id+'/refund';
            $('#amount').val(amount);

            var refund_amount = $('#refund_amount').val();
            // alert($.isNumeric(refund_amount) ? "yes" : "no"); 
            
            if($.isNumeric($('#refund_amount').val())){
              
            var token = $(this).data('token');

              if(refund_amount > amount){
                $('#refund_amount').addClass('is-invalid');
                $('.refund_amount_error').addClass('text-danger');
                $('#refund_amountHelp').text('Refund amount must be equal or lesser than amount').removeClass('hide').show();
                // alert("correct value");
                return false;
              }else{
                $.ajax({
                      url: page_url,
                      type: 'post',
                      data: {_method: 'post', _token :token, amount:amount, refund_amount:refund_amount, id:id},
                      
                      success: function( msg ) {
                          // console.log(msg);
                          // alert('#'+dtable_id+id+' > #'+id);
                          
                              $('#'+dtable_id+id+' > #'+id).text('$'+msg);
                              $("#formRefund .close").click();
                              $("#msg").slideDown().delay(2000).slideUp();

                      },
                      error: function( data ) {
                          if ( data.status === 422 ) {
                              toastr.error('Cannot delete!');
                          }
                      }
                  });
              }
             
            }else{
                $('#refund_amount').addClass('is-invalid');
              $('.refund_amount_error').addClass('text-danger');
              $('#refund_amountHelp').text('Must be numeric value').removeClass('hide').show();
              // alert("correct value");
              return false;

            }


            
        });
    });
    
   
</script>
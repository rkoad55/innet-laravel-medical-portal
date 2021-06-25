
           
           <?php 
           
           $card_detail = $CentralController->getPatientCardDetail(Auth::guard('patient')->user()->id);
           if(isset($card_detail->valid_date) && strlen($card_detail->valid_date)){
             $valid_date = explode('/', $card_detail->valid_date);
            }else{
              $valid_date = array();
              $valid_date[0] = "";
              $valid_date[1] = "";

           }
           ?> 
           
           <div class="card card-danger  card-outline">
                <div class="card-header">
                <h3 class="card-title">Payment Information</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <form role="form" id="confirm-purchase-form" novalidate="novalidate">
                    <!-- ------------------------------------------------------------------------------------------- -->
                    <div class="row">
                      
                        <div class="form-group col-md-4 required">
                            <label for="name" clas="required">Card Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$card_detail->cc_number ?? ''}}" name="cc_number" id="cardNumber">
                            
                        </div>
                        <div class="form-group col-md-1">
                            <label for="text" clas="required">CVV<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" value="{{$card_detail->cvv_number ?? ''}}" name="cvv_number" id="cvv">
                        </div>
                        <div class="form-group col-md-7" id="expiration-date">
                        <label>Expiration Date</label>
                        <div class="row">
                        <select class="form-control col-md-5" name="month" id="month">
                            <option {{($valid_date[0] == '01')?'selected=""':''}} value="01">January</option>
                            <option {{($valid_date[0] == '02')?'selected=""':''}} value="02">February </option>
                            <option {{($valid_date[0] == '03')?'selected=""':''}} value="03">March</option>
                            <option {{($valid_date[0] == '04')?'selected=""':''}} value="04">April</option>
                            <option {{($valid_date[0] == '05')?'selected=""':''}} value="05">May</option>
                            <option {{($valid_date[0] == '06')?'selected=""':''}} value="06">June</option>
                            <option {{($valid_date[0] == '07')?'selected=""':''}} value="07">July</option>
                            <option {{($valid_date[0] == '08')?'selected=""':''}} value="08">August</option>
                            <option {{($valid_date[0] == '09')?'selected=""':''}} value="09">September</option>
                            <option {{($valid_date[0]== '10')?'selected=""':''}} value="10">October</option>
                            <option {{($valid_date[0] == '11')?'selected=""':''}} value="11">November</option>
                            <option {{($valid_date[0] == '12')?'selected=""':''}} value="12">December</option>
                        </select>
                        <div style="width:20px;"></div>
                        <select class="form-control col-md-5" name="year" id="year">
                            <option {{($valid_date[1] == '20')?'selected=""':''}} value="20"> 2020</option>
                            <option {{($valid_date[1] == '21')?'selected=""':''}} value="21"> 2021</option>
                            <option {{($valid_date[1] == '22')?'selected=""':''}} value="22"> 2022</option>
                            <option {{($valid_date[1] == '23')?'selected=""':''}} value="23"> 2023</option>
                            <option {{($valid_date[1] == '24')?'selected=""':''}} value="24"> 2024</option>
                            <option {{($valid_date[1] == '25')?'selected=""':''}} value="25"> 2025</option>
                        </select>
                    </div>

                    <!--<div class="form-group" id="credit_cards">
                        <img src="assets/images/visa.jpg" id="visa">
                        <img src="assets/images/mastercard.jpg" id="mastercard">
                        <img src="assets/images/amex.jpg" id="amex">
                    </div>-->
                    </div>
                    </div>
                    <!-- ------------------------------------------------------------------------------------------- -->
                    
                   
                    
                    <!-- ------------------------------------------------------------------------------------------- -->
                   
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-success alert-dismissible hide" id="success-alert_payment">
                            Your Information has been Updated.
                          </div>
                        </div>
                      </div>
                  <!-- ------------------------------------------------------------------------------------------- -->
                
                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-danger" id="confirm-purchase">Confirm</button>
                  <span class="hide" id="loading_payment"><i class="fa fa-spinner fa-pulse fa fa-fw"></i><span class="sr-only">Loading...</span></span>
                </div>
              </form>
            </div>



<script type="text/javascript">
$(function() {

// var owner = $('#owner');
var cardNumber = $('#cardNumber');
var cardNumberField = $('#card-number-field');
var CVV = $("#cvv");
var mastercard = $("#mastercard");
var confirmButton = $('#confirm-purchase');
var visa = $("#visa");
var amex = $("#amex");

// Use the payform library to format and validate
// the payment fields.

cardNumber.payform('formatCardNumber');
CVV.payform('formatCardCVC');


cardNumber.keyup(function() {

    amex.removeClass('transparent');
    visa.removeClass('transparent');
    mastercard.removeClass('transparent');

    if ($.payform.validateCardNumber(cardNumber.val()) == false) {
        cardNumberField.addClass('has-error');
    } else {
        cardNumberField.removeClass('has-error');
        cardNumberField.addClass('has-success');
    }

    if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
        mastercard.addClass('transparent');
        amex.addClass('transparent');
    } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
        mastercard.addClass('transparent');
        visa.addClass('transparent');
    } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
        amex.addClass('transparent');
        visa.addClass('transparent');
    }
});

confirmButton.click(function(e) {
  $('#loading_payment').removeClass('hide').show();

    e.preventDefault();

    var isCardValid = $.payform.validateCardNumber(cardNumber.val());
    var isCvvValid = $.payform.validateCardCVC(CVV.val());

    if (!isCardValid) {
        $('#success-alert_payment').removeClass('hide').html("Wrong card number").show().slideDown(500).delay(2500).slideUp(500);
        $('#loading_payment').addClass('hide').hide();

    } else if (!isCvvValid) {
        $('#success-alert_payment').removeClass('hide').html("Wrong CVV").show().slideDown(500).delay(2500).slideUp(500);
        $('#loading_payment').addClass('hide').hide();

    } else {
        // Everything is correct. Add your form submission code here.
        
        // var data0 = {_token: "{{ csrf_token() }}", numberId: "1", companyId : "531"};
        var data = { cc_number:$('#cardNumber').val(), cvv_number:$('#cvv').val(), month:$('#month').val(), year:$('#year').val() };
        
        $.ajax({
              url: '{{route("patient.payment")}}',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type:'POST',
              data:data,
              success:function(result){
                  console.log(result);
                  if(result == 1){
                    $('#loading_payment').addClass('hide').hide();
                    // $('#success-alert_payment').removeClass('hide').show().slideDown(500).delay(2500).slideUp(500);
                    $('#success-alert_payment').removeClass('hide').html("Payment Detail Successfully Added to Your Account").show().slideDown(500).delay(2500).slideUp(500);

                  }
                  return false;
              },
              error:function(result){
                $('#loading_payment').addClass('hide').hide();
                    // $('#success-alert_payment').removeClass('hide').show().slideDown(500).delay(2500).slideUp(500);
                    $('#success-alert_payment').removeClass('hide').html("Something Went Wrong").show().slideDown(500).delay(2500).slideUp(500);
              }

          });
        
        
        
        
        /* $.ajax({
					type: "POST",
					url: '{{route("patient.payment")}}',
					data: data0,
					contentType: "application/json; charset=utf-8",
          dataType: "json",
					success: function(result)
					{
            console.log(result);
            if(result == 1){
              $('#loading_payment').addClass('hide').hide();
              // $('#success-alert_payment').removeClass('hide').show().slideDown(500).delay(2500).slideUp(500);
              $('#success-alert_payment').removeClass('hide').show().html(result);

            }
						return false;
					}
				}); */
    }
});
});


   

</script>
 
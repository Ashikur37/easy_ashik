"use strict";
$(function () {
    $('.select2').select2();
    $("#create-account").on('click',function () {
        $("#password-wrapper").toggleClass('d-none');
    })
    $("#ship-different").on('click',function () {
        $("#shipping-area").toggleClass('d-none');
    })
    $(".custom-payment").on('click',function () {
        $("#stripe-field").addClass('d-none');
        $("#payment-additional").load(mainUrl + '/checkout/load-payment/' + $(this).data('val'));
    })
    $(".shipping-method").on('click',function () {
        $("#ship-error").css("display", "none");
        var shippingMethod = $('input[name=shipping_method]:checked').val();
        $(".total-price").load(mainUrl + '/shipping-update/' + shippingMethod);
    });
    $(document).on('click', '.coupon-closer', {}, function (e) {
        $.ajax({
            url: mainUrl + "/cart/remove-coupon?ref=checkout&shipping=" + $('input[name=shipping_method]:checked').val() || 0,
            type: 'GET',
        }).always(function (data) {
            toastr.success('Coupon Removed')
            $("#checkout-cart").html(data)
        });
    });
    $(document).on('click', '#coupon-apply-btn', {}, function (e) {
        if (!$("#coupon-input").val()) {
            return;
        }
        $.ajax({
            url: mainUrl + "/cart/apply-coupon/" + $("#coupon-input").val() + "?ref=checkout&shipping=" + $('input[name=shipping_method]:checked').val() || 0,
            type: 'GET',
        }).always(function (data) {
            if (data == '0') {
                toastr.error('Invalid Coupon');
            } else if (data == '1') {
                toastr.error('Coupon Expired')
            } else if (data == '2') {
                toastr.error('Coupon is not applicable')
            } else if (data == '-1') {
                toastr.warning('Coupon allready applied');
            } else {
                toastr.success('Coupon applied')
                $("#checkout-cart").html(data)
            }
        });
    });
    $(document).on('click', ".apply-coupon-trigger", {}, function () {
        $(".sm-coupon-input").css("display", "block");
        $(this).css("display", "none");
    });

    $(document).on('click', '#sm-coupon-apply-btn', {}, function (e) {
        if (!$("#sm-coupon-input").val()) {
            return;
        }
        $.ajax({
            url: mainUrl + "/cart/apply-coupon/" + $("#sm-coupon-input").val() + "?ref=checkout&shipping=" + $('input[name=shipping_method]:checked').val() || 0,
            type: 'GET',
        }).always(function (data) {
            if (data == '0') {
                toastr.error('Invalid Coupon');
            } else if (data == '1') {
                toastr.error('Coupon Expired')
            } else if (data == '2') {
                toastr.error('Coupon is not applicable')
            } else if (data == '-1') {
                toastr.warning('Coupon allready applied');
            } else {
                toastr.success('Coupon applied')
                $("#checkout-cart").html(data)
            }
        });
    });

    $(document).on('blur',".require-field",{},function(){
        if(!$(this).val()){
            $(this).addClass('has-error-input');
            $(this).next().css("display","block")
        }
        else if($(this).prop("type")=="email"){
            if(!isEmail($(this).val())){
            $(this).addClass('has-error-input');
            $(this).next().css("display","block")
            
        }
        else{
            $(this).removeClass('has-error-input');
            $(this).next().css("display","none")
        }
    }
    else{
            $(this).removeClass('has-error-input');
            $(this).next().css("display","none")
        }
    });
    $(".payment_method").on('click',function(e){
        $("#pay-error").css("display","none");
        $("#payment-additional").html("");
        if($('input[name=payment_method]:checked').val()=='Stripe'){
            $("#stripe-field").removeClass('d-none')
        }
        else{
            $("#stripe-field").addClass('d-none')
        }
    });
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        if($('input[name=payment_method]:checked').val()!="Stripe"){
            return;
        }
      var $form         = $(".require-validation"),
          inputSelector = ['input[type=email]', 'input[type=password]',
                           'input[type=text]', 'input[type=file]',
                           'textarea'].join(', '),
          $inputs       = $form.find('.required').find(inputSelector),
          $errorMessage = $form.find('div.error'),
          valid         = true;
          $errorMessage.addClass('d-none');
   
          $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('d-none');
          e.preventDefault();
        }
      });
    
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
    });
    
    function stripeResponseHandler(status, response) {
        if (response.error) {
              console.log(response);
              $('.error')
                  .removeClass('d-none')
                  .find('.alert')
                  .text(response.error.message);
          } else {
              var token = response['id'];
              $form.find('input[type=text]').empty();
              $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
              if(validateCheckout()){
                  $form.get(0).submit();
              }
          }
      } 
});
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }
  function validateCheckout(){
   var valid=true;  
    $(".require-field").each(function(){
        if(!$(this).val()){
            $(this).addClass('has-error-input');
            $(this).next().css("display","block")
            if(valid){
                
                $(this).focus();
            }
            valid=false;
        }
        else if($(this).prop("type")=="email"){
            if(!isEmail($(this).val())){
                $(this).addClass('has-error-input');
                $(this).next().css("display","block");
                if(valid){
                $(this).focus();
            }
                valid=false;
            }
            else{
                $(this).removeClass('has-error-input');
                $(this).next().css("display","none"); 
            }
        }       
    });
    if(!$('input[name=shipping_method]:checked').val()){
        valid=false;
        $("#ship-error").css("display","block");
    }
    if(!$('input[name=payment_method]:checked').val()){
        valid=false;
        $("#pay-error").css("display","block");
    }

    return valid;
}
$("#term").on('click',function(){
    if(!$("#term").prop('checked')){
    $("#term-error").css("display","block");
    }
    else{
    $("#term-error").css("display","none");
    }
})
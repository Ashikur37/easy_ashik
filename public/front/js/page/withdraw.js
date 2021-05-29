"use strict";
$(function () {
    $("#method").on('change',function(){
        if($(this).val()=="Paypal"){
            $("#email").removeClass('d-none');
            $("#email").find('input, select').attr('required',true);
            $("#bank").addClass('d-none');
            $("#bank").find('input, select').attr('required',false);
        }
        else if($(this).val()=="Bank"){
            $("#email").addClass('d-none');
            $("#email").find('input, select').attr('required',false);
            $("#bank").removeClass('d-none');
            $("#bank").find('input, select').attr('required',true);
        }
        else{
            $("#email").addClass('d-none');
            $("#bank").addClass('d-none');
        }
    })
});
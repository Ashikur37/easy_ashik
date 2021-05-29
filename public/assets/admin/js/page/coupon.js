"use strict";
$(function () {
    $('.select2').select2({
    minimumResultsForSearch: -1
    });
$("#product_option").on('change',function(){
    if($(this).val()==0){
        $("#product-wrapper").removeClass("d-none");
    }
    else{
        $("#product-wrapper").addClass("d-none");
    }
})
 
})
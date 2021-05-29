"use strict";
$(function() { 
    var current = -1000;
    $(".select-wrapper").removeClass("d-none");
    var productId = 3;
    var productHTML = $("#productWrapper").html();
    $('.select2').select2();
    $("#more-product").on('click', function() {
        current++;
        productId++;
        $("#productWrapper").append(productHTML.split("#id").join(productId).split("-1000").join(
            current))
        $(".select-wrapper").removeClass("d-none");
        $('.select2').select2();
    })
})
function removeProductRow  (el) {
    el.parentElement.parentElement.parentElement.parentElement.remove();
}
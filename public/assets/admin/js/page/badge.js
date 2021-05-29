"use strict";
$(function() {
    $('.select2').select2({
        minimumResultsForSearch: -1
    });
    $("#badge-name").on('keyup',function(){
        $(".ts-badge-preview").html($(this).val().length==0?'Badge':$(this).val())
    })
    $("#badge-color").on('input',function(){
        $(".ts-badge-preview").css("color",$(this).val());
    })
    $("#badge-background").on('input',function(){
        $(".ts-badge-preview").css("background",$(this).val());
    })
})
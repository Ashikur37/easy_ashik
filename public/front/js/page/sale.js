"use strict";
$(function() {
    $("#sort").on('change', function() {
        filter();
    })
    function filter() { 
        showLoader();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                sort: $("#sort").val()
            }
        }).always(function(data) {
            hideLoader();
            $("#pills-tabContent").html(data);
        });
    }         
});
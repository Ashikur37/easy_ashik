"use strict";
$(function() {
    $(".select-wrapper").removeClass("d-none");
    $('.select2').select2();
    $('.tag2').select2({
        tags: true,
    });
});
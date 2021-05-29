"use strict";
$(function () {
    window.cartView = true;
    $(document).on('click', '.coupon-closer', {}, function (e) {
        $.ajax({
            url: mainUrl + "/cart/remove-coupon",
            type: 'GET',
        }).always(function (data) {
            toastr.error('Coupon Removed')
            $("#dynamic-cart").html(data)
        });
    });
    $(document).on('click', '#coupon-apply-btn', {}, function (e) {
        if (!$("#coupon-input").val()) {
            return;
        }
        $.ajax({
            url: mainUrl + "/cart/apply-coupon/" + $("#coupon-input").val(),
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
                $("#dynamic-cart").html(data)

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
            url: mainUrl + "/cart/apply-coupon/" + $("#sm-coupon-input").val(),
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
                $("#dynamic-cart").html(data)

            }
        });
    });


});

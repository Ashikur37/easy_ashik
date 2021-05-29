"use strict";

function showLoader() {
    $("#site-loader").removeClass("d-none");
}

function hideLoader() {
    $("#site-loader").addClass("d-none");
}

function loadHeader() {
    $.ajax({
        url: mainUrl + '/load-header',
        type: 'GET',

    }).always(function (data) {
        $("#dynamic-header").html(data.lgCart);
        $("#sm-cart-counter").html(data.smCart);
        $("#sm-all-counter").html(data.smHeader);
    })
}

function loadAsideCart() {
    $("#aside-cart").load(mainUrl + '/load-cart');
}

function copyText() {
    var copyText = document.getElementById("link");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    toastr.success("Copied the text: " + copyText.value)
}
$(function () {
    // lg device sticky menu
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 100 && ((document.body.scrollHeight - window.innerHeight) > 100)) {
            $(".middle-nav").addClass("sticky-header");
        } else {
            $(".middle-nav").removeClass("sticky-header");
        }
    });

    // sm device sticky menu
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 100 && ((document.body.scrollHeight - window.innerHeight) > 100)) {
            $(".sm-top-header-section").addClass("sm-sticky-header");
        } else {
            $(".sm-top-header-section").removeClass("sm-sticky-header");
        }
    });

    //  dynamic color picker trigger
    $(document).on('click', '.dynamic-color-panel-trigger', {}, function (e) {
        e.preventDefault();
        $('.dynamic-color-panel').toggleClass('is-active');
    });

    // nice select
    $('.ts-custom-select').niceSelect();

    // tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    // wx section
    $("#wx").on('click', function () {
        $("#wangyincunkuan2Div").css("display", "block")
    });

    // sm device search box toggler
    $(".sm-search-trigger").on('click', function () {
        removeFill();

        $('.sm-main-menu').removeClass('is-active');
        $('.product-cart-status').removeClass('is-active');
        $(".sm-search-container").toggleClass("is-active");
        $(".ts__dropdown__trigger").removeClass('dropdown-is-active');
        $(".dropdown-category").removeClass('dropdown-is-active');
        if ($('.sm-search-container').hasClass('is-active')) {
            $('.body-overlay').addClass('is-visible');
            $(this).addClass('active-bg');
        } else {
            $('.body-overlay').removeClass('is-visible');
        }

    });

    $(document).on('click', '.sm-search-closer', {}, function (e) {
        e.preventDefault();
        $('.sm-search-trigger').removeClass('active-bg');
        $('.sm-search-container').removeClass('is-active');
        $('.body-overlay').removeClass('is-visible');
    });

    $('.body-overlay').on('click', function () {
        $(this).removeClass('is-visible');
        $('.sm-search-trigger').removeClass('active-bg');
        $('.sm-search-container,.sm-search-closer').removeClass('is-active');
        $(".dropdown-category").removeClass("dropdown-is-active");
    });

    // sm menu trigger
    $(document).on('click', '.sm-main-menu-trigger', {}, function (e) {
        e.preventDefault();
        removeFill();
        $('.sm-search-container').removeClass('is-active');
        $('.product-cart-status').removeClass('is-active');
        $(".ts__dropdown__trigger").removeClass('dropdown-is-active');
        $(".dropdown-category").removeClass('dropdown-is-active');
        $('.sm-main-menu').toggleClass('is-active');
        if ($('.sm-main-menu').hasClass('is-active')) {
            $('.body-overlay').addClass('is-visible');
            $(this).addClass('active-bg');
        } else {
            $('.body-overlay').removeClass('is-visible');

        }
    });

    $('.body-overlay').on('click', function () {
        $('.sm-main-menu-trigger').removeClass('active-bg');
        $(this).removeClass('is-visible');
        $('.sm-main-menu').removeClass('is-active');
    });

    //aside cart section
    $(document).on('click', '.aside-cart-trigger', {}, function (e) {
        e.preventDefault();
        removeFill();
        $('.sm-search-container').removeClass('is-active');
        $(".ts__dropdown__trigger").removeClass('dropdown-is-active');
        $(".dropdown-category").removeClass('dropdown-is-active');
        $('.sm-main-menu').removeClass('is-active');
        $('.product-cart-status').toggleClass('is-active');
        if ($('.product-cart-status').hasClass('is-active')) {
            $('.body-overlay').addClass('is-visible');
            $(this).addClass('active-bg');
        } else {
            $('.body-overlay').removeClass('is-visible');
        }

    });

    function removeFill() {

        $('.ts__dropdown__trigger').removeClass("active-bg");
        $('.aside-cart-trigger').removeClass("active-bg");
        $('.sm-search-trigger').removeClass('active-bg');
        $('.sm-main-menu-trigger').removeClass('active-bg');

    }

    $(document).on('click', '.sidebar-cart-close', {}, function (e) {
        e.preventDefault();
        $('.aside-cart-trigger').removeClass('active-bg');
        $('.product-cart-status').removeClass('is-active');
        $('.body-overlay').removeClass('is-visible');
    });

    $('.body-overlay').on('click', function () {
        $('.aside-cart-trigger').removeClass('active-bg');
        $(this).removeClass('is-visible');
        $('.product-cart-status').removeClass('is-active');
    });

    //add to cart btn
    $(document).on('click', '.btn-plus', {}, function (e) {
        var row = $(this).data('row');
        e.preventDefault();
        $.ajax({
            url: mainUrl + "/cart/increament/" + $(this).data('row'),
            type: 'GET',
        }).always(function (data) {
            if (data["status"] == -1) {
                toastr.error('No more stock')
            } else {
                $(".qty-" + row).val(data.qty)
                $(".row-total-" + row).html(data.row_total)
                $(".cart-sub-total").html(data.sub_total)
                $(".cart-grand-total").html(data.total)
                $(".cart-tax").html(data.tax)
                $(".cart-discount").html(data.discount)
            }
        });
    });
    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }; 
    $(document).on('click', '.btn-minus', {}, debounce(function (e) {
        e.preventDefault();
        var row = $(this).data('row');

        if ($(".qty-" + row).val() < 2) {

            var productId = $(this).data('id');
            var cartURL = mainUrl + "/cart/add-item";
            $.ajax({
                url: mainUrl + "/cart/remove/" + $(this).data('row'),
                type: 'GET',
            }).always(function (data) {
                $("#aside-cart").html(data);
                $(".cart-item-" + productId).removeClass("in-cart");
                $(".cart-button-wrapper-" + productId).html("<span data-url='" + cartURL + "' data-id='" + productId + "' class='add__cart wish-btn' title='' data-toggle='tooltip' data-placement='top' data-original-title='" + lng['AddToCart'] + "'>Add to cart</span>");
                if (typeof cartView != 'undefined') {
                    $("#dynamic-cart").load(mainUrl + "/cart/load");
                }
                loadHeader();
            });
        } else {
            $.ajax({
                url: mainUrl + "/cart/decreament/" + $(this).data('row'),
                type: 'GET',
            }).always(function (data) {
                $(".qty-" + row).val(data.qty)
                $(".row-total-" + row).html(data.row_total)
                $(".cart-sub-total").html(data.sub_total)
                $(".cart-grand-total").html(data.total)
                $(".cart-tax").html(data.tax)
                $(".cart-discount").html(data.discount)
            });
        }
    },300));
    $(document).on('click', '.product-remove', {}, function (e) {
        var productId = $(this).data('id');
        $(".cart-item-" + productId).removeClass("in-cart");
        var cartURL = mainUrl + "/cart/add-item";
        $.ajax({
            url: mainUrl + "/cart/remove/" + $(this).data('row'),
            type: 'GET',
        }).always(function (data) {
            $("#aside-cart").html(data);
            $(".cart-button-wrapper-" + productId).html("<span data-url='" + cartURL + "' data-id='" + productId + "' class='add__cart wish-btn' title='' data-toggle='tooltip' data-placement='top' data-original-title='" + lng['AddToCart'] + "'>Add to cart</span>");
            if (typeof cartView != 'undefined') {
                $("#dynamic-cart").load(mainUrl + "/cart/load");
            }
            loadHeader();
        });
    });
    //end aside card section

    // order track
    //order-track-button
    $("#order-track-submit").on('click', function () {
        if (!$("#orderID").val()) {
            toastr.error("Empty order id");
        } else {
            showLoader();
            $.ajax({
                url: mainUrl + '/check-order-track/' + $("#orderID").val(),
                success: function (exist) {
                    hideLoader();
                    if (exist) {
                        location.href = mainUrl + '/order-track/' + $("#orderID").val();
                    } else {
                        toastr.error(lng['NoOrderFound']);
                    }
                }
            });
        }
    });
    $("#track_submit").on('click', function (e) {
        if (!$("#order_code").val()) {
            toastr.error("Empty order id");
        }
        var orderNumber = $("#order_code").val();
        $.ajax({
            url: mainUrl + '/check-order-track/' + orderNumber,
            success: function (exist) {
                if (exist) {
                    location.href = mainUrl + '/order-track/' + orderNumber;
                } else {
                    toastr.error(lng['NoOrderFound']);
                }
            }
        });
    })
    $(".order-track-button").on('click', function () {
        $('#orderTrack').modal('show');
        return;

    })

    //open/close mega-navigation
    $('.ts__dropdown__trigger').on('click', function (event) {
        event.preventDefault();
        removeFill();
        $('.sm-search-container').removeClass('is-active');
        $('.product-cart-status').removeClass('is-active');
        $('.sm-main-menu').removeClass('is-active');
        $('.body-overlay').removeClass('is-visible');
        toggleNav();
    });
    $(".sm-dropdown-trigger").on('click',function(){
        if($(this).hasClass('dropdown-is-active')){
            $('.body-overlay').addClass('is-visible');
        }
        else{
            $('.body-overlay').removeClass('is-visible');
        }
    })
    window.onclick = function (event) {
        if (window.screen.width > 1024) {
            var el = document.getElementsByClassName("ts__dropdown__trigger")[0];
            if (event.target != el && event.target.parentElement != el) {
                $('.dropdown-is-active').removeClass('dropdown-is-active');
                $('.ts__dropdown__trigger').removeClass('active-bg');
            }
        }
    }

    //close meganavigation
    $('.ts__dropdown .ts__close').on('click', function (event) {
        event.preventDefault();
        removeFill();
        toggleNav();
        $('.body-overlay').removeClass('is-visible');
    });

    //on mobile - open submenu
    $('.has-children.sm-device').children('a').on('click', function (event) {
        //prevent default clicking on direct children of .has-children 
        event.preventDefault();
        var selected = $(this);
        selected.next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('move-out');
    });

    //on desktop - differentiate between a user trying to hover over a dropdown item vs trying to navigate into a submenu's contents
    var submenuDirection = (!$('.ts__dropdown__wrapper').hasClass('open-to-left')) ? 'right' : 'left';
    $('.ts__dropdown__content').menuAim({
        activate: function (row) {
            $(row).children().addClass('is-active').removeClass('fade-out');
            if ($('.ts__dropdown__content .fade-in').length == 0) $(row).children('ul').addClass('fade-in');
        },
        deactivate: function (row) {
            $(row).children().removeClass('is-active');
            if ($('li.has-children:hover').length == 0 || $('li.has-children:hover').is($(row))) {
                $('.ts__dropdown__content').find('.fade-in').removeClass('fade-in');
                $(row).children('ul').addClass('fade-out')
            }
        },
        exitMenu: function () {
            $('.ts__dropdown__content').find('.is-active').removeClass('is-active');
            return true;
        },
        submenuDirection: submenuDirection,
    });

    //submenu items - go back link
    $('.go-back').on('click', function () {
        var selected = $(this),
            visibleNav = $(this).parent('ul').parent('.has-children').parent('ul');
        selected.parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('move-out');
    });

    function toggleNav() {
        var navIsVisible = (!$('.ts__dropdown').hasClass('dropdown-is-active')) ? true : false;
        $('.ts__dropdown').toggleClass('dropdown-is-active', navIsVisible);
        if ($('.ts__dropdown').hasClass('dropdown-is-active')) {
            $('.ts__dropdown__trigger').addClass('active-bg');
        }
        $('.ts__dropdown__trigger').toggleClass('dropdown-is-active', navIsVisible);
        if (!navIsVisible) {
            $('.ts__dropdown').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                $('.has-children ul').addClass('is-hidden');
                $('.move-out').removeClass('move-out');
                $('.is-active').removeClass('is-active');
            });
        }
    }

});

// start search & suggested bar
$("#searchProduct").on('focus', function () {
    $('#suggestedProduct').addClass("active-suggested");
}).on('blur', function (e) {
    setTimeout(function () {
        $('#suggestedProduct').removeClass("active-suggested");
    }, 500)
})

$(function () {
    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    $(document).on('click', '.search-all', {}, function () {
        window.location.href = mainUrl + "/category?key=" + $("#searchProduct").val();
    });
    const suggestedHTML = $("#suggestedProduct").html();
    $(document).on("keyup", "#searchProduct", debounce(function (e) {
        if (e.which == 13) {
            if ($("#search-category").val()) {
                window.location.href = mainUrl + "/category/" + $("#search-category").val() + "?key=" + $(this).val();
            } else {
                window.location.href = mainUrl + "/category?key=" + $(this).val();
            }
        }
        var val = $(this).val().trim();
        if (!val) {

            $("#suggestedProduct").html(suggestedHTML);
            return;
        } else {
            $("#suggestedProduct").load(mainUrl + '/suggest-search/' + encodeURIComponent(val) + "?category=" + encodeURIComponent($("#search-category").val()));
        }

    }, 200))
    const smSuggestedHTML = $("#smSuggestedProduct").html();
    $(document).on("keyup", "#smSearchBar", debounce(function (e) {
        if (e.which == 13) {
            window.location.href = mainUrl + "/category?key=" + $(this).val();
        }
        $("#searchProduct").val($(this).val())
        var val = $(this).val().trim();
        if (!val) {

            $("#smSuggestedProduct").html(smSuggestedHTML);
            return;
        } else {
            $("#smSuggestedProduct").load(mainUrl + '/suggest-search/' + encodeURIComponent(val));
        }

    }, 200))
    $(document).on("click", ".add-to-compare", function () {
        var id = $(this).data('id');
        var url = $(this).data('url') + "?id=" + id;
        $(this).addClass("active")
        $.ajax({
            url: url,
            type: 'GET',

        }).always(function (data) {
            loadHeader();
            toastr.success(lng['ProductAddedToCompareList'])
        });
    });

    $("#subscribe-btn").on('click', function () {
        $.ajax({
            url: mainUrl + "/subscribe/" + $("#subscribe_email").val(),
            type: 'GET',
        }).always(function (data) {

            localStorage.setItem("hide-news", true);
            $("#subscribe_email").val("")
        })
        return false;
    })
    //login-modal
    $(document).on("click", ".login-modal", {}, function () {
        $('#login-modal').modal('show');
    })
    $(document).on('click', '#modal-login-button', function () {
        if (!$("#modal-email").val() || !$("#modal-password").val()) {
            toastr.error("Emaili or Password empty");
            return;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        showLoader();
        $.ajax({
            url: mainUrl + '/login',
            type: 'POST',
            data: {
                email: $("#modal-email").val(),
                password: $("#modal-password").val(),

                submit: true
            }
        }).always(function (data) {
            hideLoader();
            if (data == 1) {
                toastr.success(lng['LoginSuccess'])
                loggedIn = true;
                window.location.reload();
            } else {
                toastr.error(lng['LoginFailed'])
            }
        })
    })
    $(document).on("click", ".add__wishlist", {}, function () {
        var id = $(this).data('id');
        if (!loggedIn) {
            $('#login-modal').modal('show');
            return;
        }
        $(this).toggleClass("active");

        var url = $(this).data('url') + "?id=" + id;
        $.ajax({
            url: url,
            type: 'GET',

        }).always(function (data) {

            if (data == 0) {
                toastr.success(lng['ProductRemovedFromWishList']);
            } else {
                toastr.success(lng['ProductAddedToWishList']);
            }
            loadHeader();

        });
    });
    //wishlist__remove
    $(document).on("click", ".wishlist__remove", function () {
        var el = $(this).parent().parent().parent().remove();
        var id = $(this).data('id');
        var url = $(this).data('url') + "?id=" + id;
        $.ajax({
            url: url,
            type: 'GET',
        }).always(function (data) {
            loadHeader();
            toastr.success(lng['ProductRemovedFromWishList']);

        });
    });
    //wishlist__remove
    $(document).on("click", ".review__remove", function () {
        var el = $(this).parent().parent().parent().remove();
        var id = $(this).data('id');
        var url = $(this).data('url') + "?id=" + id;
        $.ajax({
            url: url,
            type: 'GET',
        }).always(function (data) {
            loadHeader();
            toastr.success(lng['ReviewRemoved']);

        });
    });


    $(document).on("click", ".add__cart", function () {
        let size = "";
        let color = "";
        let optionIds = [];
        let optionValues = [];
        if ($('.color-product').length > 0 && !$(this).hasClass("related")) {
            if ($('.color-product:checked').length < 1) {
                toastr.warning(lng['PleaseSelectColor']);
                return;
            }
            color = $('.color-product:checked').data('val');
        }
        if ($('.size-product').length > 0&& !$(this).hasClass("related")) {
            if ($('.size-product:checked').length < 1) {
                toastr.warning(lng['PleaseSelectSize']);
                return;
            }
            size = $('.size-product:checked').data('val');
        }
        if ($('.option-input').length > 0&& !$(this).hasClass("related")) {
            optionIds = $(".option-input:checked").map(function () {
                return $(this).data('id');
            }).get();
            optionValues = $(".option-input:checked").map(function () {
                return $(this).data('val');
            }).get();

        }

        var productId = $(this).data('id');
        var url = $(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                productId: productId,
                optionIds: optionIds,
                optionValues: optionValues,
                color: color,
                size: size,
                submit: true
            }
        }).always(function (data) {
            if (!data.qty) {
                toastr.error(lng['OutOfStock']);
                return;
            }
            if (data.qty == 1) {
                //rowId
                $(".cart-item-" + data.id).addClass("in-cart");
                $(".cart-button-wrapper-" + data.id).html("<div class='product-count item-count list-item-count'><div class='btn-minus'  data-id='" + data.id + "' data-row='" + data.rowId + "'><button type='button' class='counter'><span><i class='ri-subtract-line'></i></span> </button></div><input type='text' class='counter-field qty-" + data.rowId + "' value='1'><div class='btn-plus' data-row='" + data.rowId + "'><button type='button' class='counter counter-plus' ><span><i class='ri-add-line'></i></span></button></div></div>")
            }

            loadHeader();
            loadAsideCart();
            toastr.success(lng['ProductAddedToCart'])

        });

    });
    $(document).on("click", ".buy-btn", function () {
        let size = "";
        let color = "";
        let optionIds = [];
        let optionValues = [];
        if ($('.color-product').length > 0&& !$(this).hasClass("related")) {
            if ($('.color-product:checked').length < 1) {
                toastr.warning(lng['PleaseSelectColor']);
                return;
            }
            color = $('.color-product:checked').data('val');
        }
        if ($('.size-product').length > 0&& !$(this).hasClass("related")) {
            if ($('.size-product:checked').length < 1) {
                toastr.warning(lng['PleaseSelectSize']);
                return;
            }
            size = $('.size-product:checked').data('val');
        }
        if ($('.option-input').length > 0&& !$(this).hasClass("related")) {
            optionIds = $(".option-input:checked").map(function () {
                return $(this).data('id');
            }).get();
            optionValues = $(".option-input:checked").map(function () {
                return $(this).data('val');
            }).get();

        }

        var productId = $(this).data('id');
        var url = $(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                productId: productId,
                optionIds: optionIds,
                optionValues: optionValues,
                color: color,
                size: size,
                submit: true
            }
        }).always(function (data) {
            if (!data.qty) {
                toastr.error(lng['OutOfStock']);
                return;
            }
            window.location.href = mainUrl + "/checkout"
        });

    });

    $(".selectors").on('change', function () {
        var url = $(this).val();
        window.location = url;
    });

    $('#quickViewModal').on('hidden.bs.modal', function () {
        $("#quick-body").html("");
    })

    $(document).on('click', '.quick-view', {}, function () {
        $("#quick-body").load(mainUrl + "/load-quick/" + $(this).data('id'), function () {
            $('#quickViewModal').modal('show');
        })
    })

    $(".table-row").on('click', function () {
        window.document.location = $(this).data("href");
    });
});
$("body").show();

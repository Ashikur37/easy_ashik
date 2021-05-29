"use strict";
$('.sm-sorting-trigger').on('click', function (e) {
    e.preventDefault();
    $('.aside-sm-filter').addClass('menu-is-active');
    $('.body-overlay').addClass('is-visible');
});
$('.body-overlay').on('click', function () {
    $(this).removeClass('is-visible');
    $('.aside-sm-filter').removeClass('menu-is-active');
});
$(document).on('click', '.page-link', {}, function (e) {
    e.preventDefault();
    filter($(this).attr('href').split("page=")[1])
})

function filter(page = 1) {
    var min = $(".price-min-value").val();
    var max = $(".price-max-value").val();
    var view = $(".view.active")[0].id;
    var colors = [];
    $(".color-variant:checked").each(function () {
        colors.push($(this).val());
    })
    var sizes = [];
    $(".product-size:checked").each(function () {
        sizes.push($(this).val());
    })
    var brands = [];
    $(".product-brand:checked").each(function () {
        brands.push($(this).val());
    })
    var attributes = [];
    $(".attribute-value:checked").each(function () {
        attributes.push($(this).val());
    })
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
            min,
            max,
            colors: JSON.stringify(colors),
            sizes: JSON.stringify(sizes),
            brands: JSON.stringify(brands),
            attrs: JSON.stringify(attributes),
            view,
            sort: $("#sort").val(),
            page,
            pageLength: $("#page").val()
        }
    }).always(function (data) {
        hideLoader();
        $("#pills-tabContent").html(data);
    });;
}

$(".color-variant").on('click', function () {
    filter();
})
$(".product-size").on('click', function () {
    filter();
})
$(".product-brand").on('click', function () {
    filter();
})
$(".attribute-value").on('click', function () {
    filter();
})
$("#sort").on('change', function () {
    filter();
})
$("#page").on('change', function () {
    filter();
})

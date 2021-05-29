"use strict";
function showReplyContainer(id, el) {
    $("#reply-container" + id).removeClass("hide");

}
$(function () {
    var demoTrigger = $('[id^="zoom-"]');
    var paneContainer = document.querySelector(".show");
    for (var i = 0; i < demoTrigger.length; i++) {
        new Drift(demoTrigger[i], {
            paneContainer: paneContainer,
            inlinePane: false,
        });
    }
    $(document).on("click", ".product-variant", function() {
    
        updatePrice();
    });
    updatePrice();
    $('input:radio').on('change',
    function() {
        var userRating = this.value;
    });
    $('.product-image-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.product-thumbs'
    });
    $('.product-thumbs').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.product-image-slider',
    arrows: false,
    dots: false,
    focusOnSelect: true,
    infinity:true,
    });
    $('.image-zoom').zoom(); 
    $('.slick-slider').show(); 
    $('.gallery').show(); 
});

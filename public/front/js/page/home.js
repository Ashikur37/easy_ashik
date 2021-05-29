"use strict";
$(function() {
    $("#hide-news-letter").on('click',function() {
        localStorage.setItem("hide-news", true);
        $("#newsLatterModal").modal('hide')
    })

    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            var t = getTimeRemaining(endtime);
            daysSpan.innerHTML = t.days;
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }
        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }
    if(flashSale){
    initializeClock('flashClock', deadline);
    initializeClock('smFlashClock', deadline);
    }
    $("#extra").load(mainUrl+"/load-home",function(){
  // best deal slider 
  $('.best-deal-products').slick({
    autoplay:false,
    arrows: false,
    dots: true,
    infinite: true,   
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
    prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 630,
        settings: {
          autoplay:true,
          autoplaySpeed: 4000,
          slidesToShow: 1.8,
        }
      },
      {
        breakpoint: 575,
        settings: {  
          autoplay:true,
          dots:false,
          autoplaySpeed: 4000,
          arrows: false,
          slidesToShow: 1,
        }
      }
    ] 
  })


  $('.top-brands-slider').slick({
    autoplay: true,
    arrows: true,
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 6,
    slidesToScroll: 1,
    nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
    prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,

        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 2,
        }
      }
    ]    
  })

// three column product 
  $('.trending-products').slick({
    autoplay: true,
    arrows: true,
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
    prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
  })

  $('.top-rated-slider').slick({
    autoplay: true,
    arrows: true,
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
    prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
  })
  $(".top-in-category-item").on('click',function(){
    window.location.href=$(this).data("href");
  })
  $('.hot-item-slider').slick({
    autoplay: true,
    arrows: true,
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
    prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
  })

     // all  slider 
     $('.product-slider').slick({
      autoplay:false,
      arrows: false,
      dots: false,
      infinite: true,   
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
      prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
      responsive: [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 5,
          }
        },
        {
          breakpoint:1200,
          settings: {
            slidesToShow: 4,   
          }
        },
        {
          breakpoint:880,
          settings: {
            slidesToShow: 3,   
          }
        },
        {
          breakpoint: 680,
          settings: {  
            arrows: false,
            slidesToShow: 2,
          }
        }
      ] 
    })


    $(".sub-product").on('click',function(){
      showLoader();
      $('.category-tab-menu').removeClass('active');
      $('.categoryToggler').removeClass('ri-close-fill');
      $('.categoryToggler').addClass('ri-menu-line');
  
      var cat=$(this).data('category');
      
      if($("#sub-wrapper"+cat).hasClass("slick-initialized")){
        $("#sub-wrapper"+cat).slick('unslick');
      }
      $(".sub-"+cat).removeClass("active");
      $(this).addClass("active");
      $("#sub-wrapper"+cat).html(`
      <div aria-live="polite" class="slick-list draggable"></div>`);
      $("#sub-wrapper"+cat).load(mainUrl+"/load-sub-product/"+$(this).data('id'),function(){
        $("#sub-wrapper"+cat).slick({
          autoplay:false,
          arrows: false,
          dots: false,
          infinite: true,   
          speed: 300,
          slidesToShow: 6,
          slidesToScroll: 1,
          nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
          prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
          responsive: [
            {
              breakpoint: 1400,
              settings: {
                slidesToShow: 5,
              }
            },
            {
              breakpoint:1200,
              settings: {
                slidesToShow: 4,   
              }
            },
            {
              breakpoint:992,
              settings: {
                slidesToShow: 3,   
              }
            },
            {
              breakpoint: 680,
              settings: {  
                arrows: false,
                slidesToShow: 2,
              }
            }
          ] 
        })
        hideLoader();
      });
    })
  //end extra load hml
    });
});
function subscribe() {
    $.ajax({
        url: mainUrl + "/subscribe/" + $("#sub_email").val(),
        type: 'GET',
    }).always(function(data) {
        toastr.success(data);
        localStorage.setItem("hide-news", true);
        $("#newsLatterModal").modal('hide')
    })
    return false;
}
$(window).on('load', function() {
    if (!localStorage.getItem("hide-news")) {
        $('#newsLatterModal').modal('show');
    }
});

// category ajax menu
$('.categoryToggler').on('click',function() {
  $(this).toggleClass('ri-menu-line').toggleClass('ri-close-fill');
  $(this).siblings('ul').first().toggleClass('active');
});

// Init slick slider + animation
$('.home-slider').slick({
    autoplay: false,
    autoplaySpeed: 4000,
    speed: 800,
    lazyLoad: 'progressive',
    arrows: true,
    dots: true,
    nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
    prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
    responsive: [
      {
        breakpoint: 575,
        settings: {
          arrows: false,
        }
      }
    ]
   
  }).slickAnimation();

     // flash  slider 
     $('.flash-slider').slick({
      autoplay:false,
      arrows: false,
      dots: false,
      infinite: true,   
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
      prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
      responsive: [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 5,
          }
        },
        {
          breakpoint:1200,
          settings: {
            slidesToShow: 4,   
          }
        },
        {
          breakpoint:880,
          settings: {
            slidesToShow: 3,   
          }
        },
        {
          breakpoint: 680,
          settings: {  
            arrows: false,
            slidesToShow: 2,
          }
        }
      ] 
    })



    // top in category
//   $('.top-in-category').slick({
//   autoplay: false,
//   arrows: false,
//   dots: false,
//   infinite: true,
//   speed: 300,
//   focusOnSelect: true,
//   slidesToShow: 6,
//   slidesToScroll: 1,
//   nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="ri-arrow-right-s-line"></i></div>',
//   prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="ri-arrow-left-s-line"></i></div>',
//   responsive: [
//     {
//       breakpoint: 992,
//       settings: {
//         slidesToShow: 3.8,
//       }
//     },
//     {
//       breakpoint: 768,
//       settings: {
//         slidesToShow: 2.8,
//       }
//     },
//     {
//       breakpoint: 576,
//       settings: {
//         slidesToShow: 2.5,
//       }
//     },
//     {
//       breakpoint: 420,
//       settings: {
//         slidesToShow: 1.8,
//       }
//     }
//   ] 
// })

  // brand slider 

  // $('.best-deal-section').show();
  $('.slick-slider').show();
  $('.top-category-section').show();

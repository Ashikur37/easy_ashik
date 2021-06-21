@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 mb-20">
                <div class="campaign-card">
                   <a href="">
                    <div class="img-wrap">
                        <img src="{{asset('images/voucher/campaign-banner.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-wrapper">
                        <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                    </div>
                   </a>
                   <div id="timer">
                    <div class="unit-list">
                        <div class="item">Day</div>
                        <div class="item">Hour</div>
                        <div class="item">Min</div>
                        <div class="item">Sec</div>
                      </div>
                    <div class="number-list">
                      <div class=""><div class="item" data-days="">00</div></div>
                      <div class="item" data-hours="">00</div>
                      <div class="item" data-minutes="">00</div>
                      <div class="item" data-seconds="">00</div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6 mb-20">
                <div class="campaign-card">
                   <a href="">
                    <div class="img-wrap">
                        <img src="{{asset('images/voucher/campaign-banner.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-wrapper">
                        <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                    </div>
                   </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pageScripts')


    <script>


(function ($) {
  "use strict";
  $.fn.aksCountDown = function (options) {
    const aks = $(this);
    var settings = $.extend(
      {
        endTime: "",
        refresh: 1000,
        onEnd: function () {}
      },
      options
    );
    return this.each(function (i) {
      function endTimeCheck(d1, d2) {
        return (
          d1.getFullYear() === d2.getFullYear() &&
          d1.getMonth() === d2.getMonth() &&
          d1.getDate() === d2.getDate()
        );
      }
      function countTimer() {
        var endTime = new Date(settings.endTime);
        endTime = Date.parse(endTime) / 1000;

        var now = new Date();
        now = Date.parse(now) / 1000;

        var timeLeft = endTime - now;

        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - days * 86400) / 3600);
        var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
        var seconds = Math.floor(
          timeLeft - days * 86400 - hours * 3600 - minutes * 60
        );

        if (hours < "10") {
          hours = "0" + hours;
        }
        if (minutes < "10") {
          minutes = "0" + minutes;
        }
        if (seconds < "10") {
          seconds = "0" + seconds;
        }

        $(aks).find("[data-days]").html(days);
        $(aks).find("[data-hours]").html(hours);
        $(aks).find("[data-minutes]").html(minutes);
        $(aks).find("[data-seconds]").html(seconds);
      }
      var now = new Date();
      var endTime = new Date(settings.endTime);

      if (endTimeCheck(now, endTime) === true) {
        settings.onEnd.call(aks);
      } else {
        setInterval(function () {
          countTimer();
        }, settings.refresh);
      }
    });
  };
})(jQuery);

$("#timer").aksCountDown({
  endTime: "15 June 2022 9:56:00 GMT+01:00",
  onEnd: function () {
    $(this).html('<div class="timer-end">Finished Time</div>');
  }
});

    </script>
@endsection
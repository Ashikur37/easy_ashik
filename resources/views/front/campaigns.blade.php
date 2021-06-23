@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row my-5 pt-3">
            <div class="col-md-6 mb-20 prl-10">
                <div class="campaign-card">
                   <a href="">
                    <div class="img-wrap">
                        <img src="{{asset('images/voucher/campaign-banner.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-wrapper">
                        <h2 class="section-title">Meghna Pulp &amp;  Paper Mills Ltd</h2>
                    </div>
                   </a>

                   <div id="clockdiv">
                    <div>
                        <div class="smalltext">Day</div>
                      <span class="days"></span>
                    </div>
                    <div>
                      <div class="smalltext">Hour</div>
                      <span class="hours"></span>
                    </div>
                    <div>
                        <div class="smalltext">Min</div>
                      <span class="minutes"></span>
                    </div>
                    <div>
                      <div class="smalltext">Sec</div>
                      <span class="seconds"></span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6 mb-20 prl-10">
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

var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
initializeClock('clockdiv', deadline);
</script>

@endsection
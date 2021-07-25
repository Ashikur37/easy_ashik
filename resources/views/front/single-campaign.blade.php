@extends('layouts.front')
@section('title', "$campaign->title")
@section('pageStyle')
    <link rel="stylesheet" href="{{ asset('front') }}/css/page/category.css">
@endsection
@section('content')
    <div class="container">
       <div class="row">
            <div class="col prl-0">
                 <div class="mt-20">
                    <div class="banner-img flash-sale-banner">
                        @if ($campaign->image)
                            <img src="{{ asset('/images/campaign/' . $campaign->image) }}" alt="banner">
                        @endif
                    </div>
                </div>
            </div>
       </div>
    </div>
 
    <div class="container white-bg mb-20">
        <div class="row mb-20 pt-20">
            <div class="col-5">
                <div class="sorting-left d-inline-block">
                    <h4>{{ $campaign->title }}</h4>
                </div>
            </div>
            <div class="col-7">
                <div class="sorting-right justify-content-end">
                    <select id="sort" class="ts-custom-select">
                        <option value="0">{{ $lng->Latest }}</option>
                        <option value="7">{{ $lng->Popular }}</option>
                        <option value="6">{{ $lng->TopRated }}</option>
                        <option value="2">{{ $lng->PriceLowToHigh }}</option>
                        <option value="3">{{ $lng->PriceHighToLow }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-xl-2 col-md-3 col-6 mb-20 sm-mb-15 {{ $loop->even ? 'sm-pl' : 'sm-pr' }} prl-10">
                    @include('common.product.style1')
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="{{ asset('front/js/page/sale.js') }}"></script>
    <script>
    $(function() { 
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
      daysSpan.innerHTML = t.days==0?'':t.days+':';
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
 
 
     
    })
    </script>
@endsection

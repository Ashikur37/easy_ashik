@extends('layouts.user')
@section('title', "$lng->Notification")
@section('content')
<div class="user-panel-content-wrapper">
  <div class="main-content-wrapper notification-container">
      <h4 class="section-title">{{$lng->Notification}}</h4>
       <div class="notification-wrapper mt-30">
        @foreach($notifications as $notification)
        <div class="single-notification">
          <a href="#" class="notification-link notification-card" data-url="{{$notification->data["link"]}}" data-id="{{$notification->id}}">
            <div class="notification-content">
              <img src="{{asset('icons/'.$notification->data["icon"])}}" alt="icon">
              <div class="notification-content-info">
                <span class="mb-0 {{$notification->read_at?'seen':''}} text-truncate">{{$notification->data["title"]}}</span>
                <p class="mb-0 {{$notification->read_at?'seen':''}}">
                  {!!$notification->data["text"]!!}</p>
              </div>
            </div>
            <div class="notification-time">
              <span class="{{$notification->read_at?'seen':''}}">{{$notification->created_at->diffForHumans()}}</span>
              <span class="notification-status {{$notification->read_at?'seen':''}}"></span>
            </div>
          </a>
        </div>
        @endforeach
       </div>
    </div>
  <div class="row mt-25 px-30">
    <div class="col-sm-4 col-12 mb-3 mb-sm-0 text-center text-sm-left">
      <span class="mb-0 pagination-title">
        @if($notifications->total()>0)
        Showing
        {{($notifications->currentpage()-1)*$notifications->perpage()+1}}
        to
        {{(($notifications->currentpage()-1)*$notifications->perpage())+$notifications->count()}} of {{$notifications->total()}} entries
        @endif
      </span>
    </div>
    <div class="col-sm-8 col-12">
      <div class="float-sm-right">{!!$notifications->onEachSide(1)->links()!!}</div>
    </div>
  </div>
</div>
@endsection
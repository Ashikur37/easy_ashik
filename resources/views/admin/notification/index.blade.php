@extends('layouts.admin',['headerText' => $lng->Notification])
@section('title', "$lng->Notification")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->Notification }}</a>
    </li>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/page/static.css">
@endsection
@section('content')
    <div class="container-fluid all-notification-section">
        <div class="row">
            @foreach ($notifications as $notification)
                <div class="col-12">
                    <a href="#" class="notification-link" data-url="{{ $notification->data['link'] }}"
                        data-id="{{ $notification->id }}">
                        <div class="p-3 notification-content-wrapper">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img src="{{ asset('icons/' . $notification->data['icon']) }}" alt="Notification">
                                    <div class="notification-content">
                                        <h6 class="mb-0 {{ $notification->read_at ? 'seen' : '' }}">
                                            {{ $notification->data['title'] }}
                                        </h6>
                                        <p class="mb-0 {{ $notification->read_at ? 'seen' : '' }}">
                                            {!! $notification->data['text'] !!}</p>
                                    </div>
                                </div>
                                <div class="notification-time ">
                                    <span
                                        class="{{ $notification->read_at ? 'seen' : '' }}">{{ $notification->created_at->diffForHumans(null, true, true) }}</span>
                                    <span
                                        class="notification-status {{ $notification->read_at ? 'seen' : 'unseen' }}"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row py-3">
            <div class="col-sm-4 col-12 mb-3 mb-sm-0 text-center text-sm-left">
                <h4 class="mb-0 mt-2">
                    Showing
                    {{ ($notifications->currentpage() - 1) * $notifications->perpage() + 1 }}
                    to
                    {{ ($notifications->currentpage() - 1) * $notifications->perpage() + $notifications->count() }} of
                    {{ $notifications->total() }} entries
                </h4>
            </div>
            <div class="col-sm-8 col-12">
                <div class="float-sm-right">{!! $notifications->onEachSide(1)->links() !!}</div>
            </div>
        </div>
    </div>
@endsection

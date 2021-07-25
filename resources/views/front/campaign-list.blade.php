@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row my-20">
            @foreach($campaigns as $campaign)
            <div class="col-md-6 mb-20 prl-10">
                <a href="{{route('single-campaign',$campaign->title)}}">
                    <div class="single-card d-flex">
                        <div class="img-wrap">
                            <img src="{{asset('images/campaign/'.$campaign->image)}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">{{$campaign->title}}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
@endsection
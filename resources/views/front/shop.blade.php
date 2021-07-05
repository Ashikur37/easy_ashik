@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row my-20">
            @foreach($shops as $shop)
            <div class="col-md-6 mb-20 prl-10">
                <a href="{{route('single-shop',$shop->name)}}">
                    <div class="single-card d-flex">
                        <div class="img-wrap">
                            <img src="{{asset('images/shop/'.$shop->image)}}" alt="" class="img-fluid">
                        </div>
                        <div class="content-wrapper">
                            <h2 class="section-title">{{$shop->name}}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
@endsection
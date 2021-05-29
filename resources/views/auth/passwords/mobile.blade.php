@extends('layouts.front')
@section('pageStyle')
<link rel="stylesheet" href="{{asset('front')}}/css/page/register.css">
@endsection
@section('content')
<div class="container reset-password-page">
    <div class="row">
        <div class="col-md-4 offset-md-4 col-10 offset-1 white-bg p-40">
            <div class="reset-password">
                <form method="POST" action="{{ route('password.mobile') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Mobile Number</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="default-btn reset-btn">
                            {{ __('Send Password Reset Code') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
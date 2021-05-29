@extends('layouts.front')
@section('content')
<div class="container">
    <div class="row justify-content-center reset-section">
        <div class="col-md-6 py-5">
            <div class="card">
                <h4 class="mb-0 text-center pt-3">{{ __('Reset Password') }}</h4>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.mobile_update') }}">
                        @csrf
                        <div class="form-group">
                           <label for="email">OTP Code</label>
                           <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $code ?? old('code') }}" required autocomplete="email" autofocus>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="default-btn reset-btn">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


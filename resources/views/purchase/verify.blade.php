@extends('vendor.installer.layouts.master')

@section('template_title')
    Verify Purchase
@endsection

@section('title')
     Verify Purchase
@endsection

@section('container')
    <form method="post" action="{{route('verify-purchase')}}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="app_name">
                Purchase Code
            </label>
            <input required type="text" name="purchase_code"  value="" placeholder="Enter Purchase Code" />
            @if(Session::has('error'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ Session::get('error') }}
                </span>
            @endif
        </div>
        <div class="buttons buttons--right">
            <button class="button button--success" type="submit">       	
                Verify
            </button>
        </div>
    </form>
@endsection
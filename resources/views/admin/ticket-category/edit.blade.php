@extends('layouts.admin',['headerText' => $lng->EditTicketCategory])
@section('title', "$lng->EditTicketCategory")
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->EditTicketCategory }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('ticket-category.update', $ticketCategory->id) }}">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item top-info-header">
                        <div>
                            <a href="{{ route('ticket-category.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
                        </div>
                        <div>
                            <input type="submit" value="{{ $lng->Save }}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Name }} <span>*</span></label>
                        <input value="{{ $ticketCategory->name }}" name="name" required type="text" class="form-control"
                            placeholder="{{ $lng->Name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

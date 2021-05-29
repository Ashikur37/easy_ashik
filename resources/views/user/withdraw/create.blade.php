@extends('layouts.user')
@section('title', "$lng->CreateWithdraw")
@section('content')
<div class="user-panel-content-wrapper">
    <div class="tab-pane" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
        <div class="main-content-wrapper withdraw-container">
            <h4 class="section-title">{{$lng->WithdrawNow}}</h4>
            <form action="{{route('user.withdraw.store')}}" method="POST" class="withdraw-form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >{{$lng->WithdrawAmmount}}</label> 
                            <input max="{{App\Model\Product::currencyPriceRateWithoutSign(auth()->user()->affiliate_balance)}}" required type="number" class="form-control" id="amount" name="amount" placeholder="" /> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label >{{$lng->WithdrawMethod}}</label>
                            <select required id="method" name="method" class="ts-custom-select wide">
                            <option value="">{{$lng->SelectMethod}}</option>
                            <option value="Paypal">{{$lng->Paypal}}</option>
                            <option value="Bank">{{$lng->Bank}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="email" class="d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label >{{$lng->Email}}*</label>
                                <input name="email" type="email" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label > {{$lng->AdditionalReference}}</label>
                                <input name="email_reference" type="text" class="form-control" id="ref" />
                            </div>
                        </div>
                    </div>
                </div>
                <div id="bank" class="d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >{{$lng->IBAN}} *</label>
                                <input name="iban" type="text" class="form-control" placeholder="Enter IBAN/Account No " />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>{{$lng->AccountName}}</label>
                                <input name="account_name" type="text" class="form-control" placeholder="{{$lng->AccountName}}" />
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{$lng->Address}} *</label>
                                <input name="address" type="text" class="form-control" placeholder="{{$lng->Address}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>{{$lng->SwiftCode}}</label>
                                <input name="swift" type="text" class="form-control" placeholder="{{$lng->SwiftCode}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>{{$lng->AdditionalReference}}</label>
                                <input name="banke_reference" type="text" class="form-control"  />
                            </div>
                        </div>                  
                    </div>
                </div>
                <div class="form-group mb-10">
                <input class="default-btn" type="submit" value="{{$lng->Withdraw}}">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('pageScripts')
<script src="{{asset('front/js/page/withdraw.js')}}"></script>
@endsection
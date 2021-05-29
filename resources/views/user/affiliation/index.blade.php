@extends('layouts.user')
@section('title', "$lng->Affiliation")
@section('content')
    <div class="user-panel-content-wrapper">
        <div class="main-content-wrapper affliation-container">
            <h4 class="section-title">{{ $lng->MyAffiliation }}</h4>
            <div class="affliation-link-wrapper">
                <span class="title">{{ $lng->AffiliateLink }}</span>
                <div class="link-input-wrapper">
                    <input type="text" name="link" class="link__input" id="link"
                        value="{{ URL::to('/?user=' . auth()->user()->affiliate_link) }}" readonly="readonly" />
                    <button onclick="copyText()" class="default-btn copy-button">{{ $lng->CopyLink }}</button>
                </div>
            </div>
            <div class="balance-status-row">
                <span class="status-title">{{ $lng->BalanceStatus }}</span>
                <div class="status-row">
                    <span>{{ $lng->TotalEarned }}</span>
                    <span>{{ App\Model\Product::currencyPriceRate(
                        auth()->user()->withdrawAmount() +
                            auth()->user()->spent() +
                            auth()->user()->affiliate_balance,
                    ) }}</span>
                </div>
                <div class="status-row">
                    <span>{{ $lng->BoughtProducts }}</span>
                    <span>{{ App\Model\Product::currencyPriceRate(
                        auth()->user()->spent(),
                    ) }}</span>
                </div>
                <div class="status-row">
                    <span>{{ $lng->Withdrawn }}</span>
                    <span>{{ App\Model\Product::currencyPriceRate(
                        auth()->user()->withdrawAmount(),
                    ) }}</span>
                </div>
                <div class="status-row">
                    <span>{{ $lng->CurrentBalance }}</span>
                    <span>{{ App\Model\Product::currencyPriceRate(auth()->user()->affiliate_balance) }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

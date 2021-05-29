@extends('layouts.user')
@section('title', "$lng->Withdraw")
@section('content')
<div class="user-panel-content-wrapper"> 
    <div class="main-content-wrapper withdraw-container">
        <h4 class="section-title bb-none">
            {{$lng->Withdraw}}
                <a class="default-btn withdraw-btn" href="{{route('user.withdraw.create')}}">{{$lng->WithdrawNow}}</a>
        </h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="title-row">
                        <th>{{$lng->Amount}}</th>
                        <th>{{$lng->PaymentMethod}}</th>
                        <th>{{$lng->Details}}</th>
                        <th>{{$lng->Reference}}</th>
                        <th>{{$lng->Status}}</th>
                        <th>{{$lng->WithdrawAt}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws as $withdraw)
                    <tr>
                        <td><span>{{$withdraw->amount}}</span></td>
                        <td><span>{{$withdraw->method}}</span></td>
                        <td>
                            @if($withdraw->method=='Bank')
                            <ul class='list-group'>
                                <li class='list-group-item'>
                                    {{$lng->AccountName}}:{{$withdraw->account_name}}
                                </li>
                                <li class='list-group-item'>
                                    {{$lng->IBAN}}:{{$withdraw->iban}}
                                </li>
                                <li class='list-group-item'>
                                    {{$lng->Address}}:{{$withdraw->address}}
                                </li>
                                <li class='list-group-item'>
                                    {{$lng->SwiftCode}}:{{$withdraw->swift}}
                                </li>
                            </ul>

                            @else
                            <ul class='list-group'>
                                <li class='list-group-item'>
                                    {{$lng->Email}} : {{$withdraw->email}}
                                </li>
                            </ul>
                            @endif
                        </td>
                        <td><span>{{$withdraw->reference}}</span></td>
                        <td>
                            <span class="status-badge {{['warning','success'][$withdraw->status]}}">{{['Pending','Completed'][$withdraw->status]}}</span>
                        </td>
                        <td><span>{{$withdraw->created_at->diffForHumans()}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>             
    </div>
    {!!$withdraws->links()!!} 
</div>
@endsection

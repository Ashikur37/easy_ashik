@extends('layouts.user')
@section('title', "My Address")
@section('content')
<div class="user-panel-content-wrapper">
    <div class="main-content-wrapper reviews-container">
        <h4 class="section-title bb-none">
            My Address
                <a class="btn btn-success" href="{{route('user-address.create')}}">Create Address</a>
        </h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="title-row">
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">City</th>
                        <th scope="col">ZIP</th>
                        <th scope="col">Address</th>
                        <th scope="col">Region</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                    <tr class="reviews-row">
                        <td>{{$address->first_name}} {{$address->last_name}}</td>
                        <td>{{$address->mobile}}</td>
                        <td>{{$address->email}}</td>
                        <td>{{$address->city}}</td>
                        <td>{{$address->zip}}</td>
                        <td>{{$address->street_address}}</td>
                        <td>{{$address->region}}</td>
                        <td><a style="color:white" class="btn btn-danger" href="{{URL::to('/user/address/delete/'.$address->id)}}">Delete</a></td>
                    </tr>                            
                    @endforeach
                </tbody>
            </table>
        </div>          
    </div>
</div>
@endsection

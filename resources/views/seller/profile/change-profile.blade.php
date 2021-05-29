@extends('layouts.vendor',['headerText' => "Update Store"])
@section('title', "Update Store")
@section('content')
<div class="container-fluid">
    <div class="main-content-wrapper changepassword-container">
        <h4 class="section-title">Update Store</h4>
        <form action="{{route('vendor.update-profile')}}" method="POST" class="changePassword-form">
            @csrf         
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="oldpassword">Phone</label>
                        <input value="{{$vendor->phone}}" required type="text" class="form-control"  name="phone" placeholder="" />
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="password">Address</label>
                        <input value="{{$vendor->address}}" required type="text" class="form-control"  name="address" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Store Name</label>
                        <input value="{{$vendor->store_name}}" required type="text" class="form-control"  name="store_name" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Facebook</label>
                        <input value="{{$vendor->facebook}}"  type="text" class="form-control"  name="facebook" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Instagram</label>
                        <input value="{{$vendor->instagram}}"  type="text" class="form-control"  name="instagram" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="confirmpassword">Twitter</label>
                        <input value="{{$vendor->twitter}}"  type="text" class="form-control"  name="twitter" placeholder="" />
                    </div>
                </div>
            </div>
           

            <div class="form-group mb-10">
                <input class="btn btn-info" type="submit" value="{{$lng->Save}}">
            </div>
        </form>
    </div>
</div>
@endsection
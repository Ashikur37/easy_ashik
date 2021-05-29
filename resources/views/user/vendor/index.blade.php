@extends('layouts.user')
@section('title', "$lng->ApplyForVendor")
@section('content')
    <div class="user-panel-content-wrapper">
        <div class="main-content-wrapper reviews-container">
            <h4 class="section-title bb-none">{{ $lng->ApplyForVendor }}</h4>
            <form action="{{ route('vendor.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Store Name</label>
                    <input required name="store_name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input onblur="checkPhoneNumber(this.value,'phone-error')" required name="phone" type="text" class="form-control">
                    <span style="color:#d73434;font-size:12px" class="d-none" id="phone-error">
                        Invalid Phone No
                    </span>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input required name="address" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Product Type</label>
                    <input type="text" class="form-control" name="product_type">
                   
                </div>
                <div class="form-group">
                    <label>NID/Trade License</label>
                    <input required name="nid_trade" type="text" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label>Dealing System</label>
                    {{-- <input  name="dealing_system" type="text" class="form-control"> --}}
                     <select name="dealing_system" id="" class="form-control">
                        <option value="Wholesales">Wholesale</option>
                        <option value="Retail">Retail</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mobile Banking Number</label>
                    <input onblur="checkPhoneNumber(this.value,'mobile-error')" required name="mobile_banking_no" type="text" class="form-control">
                    <span style="color:#d73434;font-size:12px" class="d-none" id="mobile-error">
                        Invalid Phone No
                    </span>
                </div>
                <div class="form-group">
                    <label>Mobile Bank System</label>
                    {{-- <input  name="mobile_bank_type" type="text" class="form-control"> --}}
                    <select name="mobile_bank_system" id="" class="form-control">
                        <option value="bkash">Bkash</option>
                        <option value="rocket">Rocket</option>
                        <option value="nagad">Nagad</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mobile Bank Type</label>
                    {{-- <input  name="mobile_bank_type" type="text" class="form-control"> --}}
                    <select name="mobile_bank_type" id="" class="form-control">
                        <option value="agent">Agent</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bank Account Number</label>
                    <input  name="bank_account_no" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Bank Name</label>
                    <input  name="bank_name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Branch</label>
                    <input  name="branch" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id='apply-btn'>
                        Apply
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('pageScripts')
<script>
    function checkPhoneNumber(val,id){
        if(checkphone(val)){
            $("#"+id).addClass('d-none')
            
        }
        else{
            $("#"+id).removeClass('d-none')
            

        }
    }
    function checkphone(check_number){
        var phoneno = /^(?:\+?88)?01[13-9]\d{8}$/;
        if(check_number.match(phoneno))  
            {  
                $("#apply-btn").prop('disabled',false);
                return true;
            } 
            $("#apply-btn").prop('disabled',true);
            return false;
    }
</script>    
@endsection
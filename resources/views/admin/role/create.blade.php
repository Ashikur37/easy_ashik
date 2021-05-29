@extends('layouts.admin',['headerText' => $lng->AddRole])
@section('title', "$lng->AddRole")
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css') }}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{ $lng->AddRole }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form method="post" action="{{ route('role.store') }}" class="ts__product__upload" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                            <a href="{{ route('role.index') }}" class="list-btn">{{ $lng->SeeList }}</a>
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
                        <input name="name" required type="text" class="form-control" placeholder="{{ $lng->Name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ $lng->Label }}</label>
                        <input name="label" type="text" class="form-control" placeholder="{{ $lng->Label }}">
                    </div>
                </div>
            </div>
            <div id="permission-wrapper" class="d-none">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Category }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="1,2,3,4,59,60,61,62,63,64,65,66,67,68,69,84,85,86">{{ $lng->All }}</option>
                                <option value="1,59,63">{{ $lng->View }}</option>
                                <option value="2,60,64,84,85,86">{{ $lng->Create }}</option>
                                <option value="3,61,65,67,68,69">{{ $lng->Edit }}</option>
                                <option value="4,62,66">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Brand }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="5,6,7,8,70,87">{{ $lng->All }}</option>
                                <option value="5">{{ $lng->View }}</option>
                                <option value="6,87">{{ $lng->Create }}</option>
                                <option value="7,70">{{ $lng->Edit }}</option>
                                <option value="8">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Badge }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="13,14,15,16,72,89">{{ $lng->All }}</option>
                                <option value="13">{{ $lng->View }}</option>
                                <option value="14,89">{{ $lng->Create }}</option>
                                <option value="15,72">{{ $lng->Edit }}</option>
                                <option value="16">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Coupon }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="17,18,19,20,73,90">{{ $lng->All }}</option>
                                <option value="17">{{ $lng->View }}</option>
                                <option value="18,90">{{ $lng->Create }}</option>
                                <option value="19,73">{{ $lng->Edit }}</option>
                                <option value="20">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Currency }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="21,22,23,24,74,91">{{ $lng->All }}</option>
                                <option value="21">{{ $lng->View }}</option>
                                <option value="22,91">{{ $lng->Create }}</option>
                                <option value="23,74">{{ $lng->Edit }}</option>
                                <option value="24">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->FlashSale }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="25,26,27,28,75,92,189,190,191,192,193,194">{{ $lng->All }}</option>
                                <option value="25,189">{{ $lng->View }}</option>
                                <option value="26,92,190,193">{{ $lng->Create }}</option>
                                <option value="27,75,191,194">{{ $lng->Edit }}</option>
                                <option value="28,192">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Page }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="29,30,31,32,76,93,129,130,131,132,133,134">{{ $lng->All }}</option>
                                <option value="29,129">{{ $lng->View }}</option>
                                <option value="30,93,130,133">{{ $lng->Create }}</option>
                                <option value="31,76,131,134">{{ $lng->Edit }}</option>
                                <option value="32,132">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Report }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="33">{{ $lng->All }}</option>
                                <option value="33">{{ $lng->View }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Setting }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="34,77">{{ $lng->All }}</option>
                                <option value="34,77">{{ $lng->Edit }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Slider }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="35,36,37,38,78,94">{{ $lng->All }}</option>
                                <option value="35">{{ $lng->View }}</option>
                                <option value="36,94">{{ $lng->Create }}</option>
                                <option value="37,78">{{ $lng->Edit }}</option>
                                <option value="38">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Tag }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="39,40,41,42,79,95">{{ $lng->All }}</option>
                                <option value="39">{{ $lng->View }}</option>
                                <option value="40,95">{{ $lng->Create }}</option>
                                <option value="41,79">{{ $lng->Edit }}</option>
                                <option value="42">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Withdraw }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="182,183,185">{{ $lng->All }}</option>
                                <option value="182">{{ $lng->View }}</option>
                                <option value="183">{{ $lng->Edit }}</option>
                                <option value="185">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->User }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="47,48,49,50,81,97,188">{{ $lng->All }}</option>
                                <option value="47,188">{{ $lng->View }}</option>
                                <option value="48,97">{{ $lng->Create }}</option>
                                <option value="49,81">{{ $lng->Edit }}</option>
                                <option value="50">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Blog }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="51,52,53,54,82,98">{{ $lng->All }}</option>
                                <option value="51">{{ $lng->View }}</option>
                                <option value="52,98">{{ $lng->Create }}</option>
                                <option value="53,82">{{ $lng->Edit }}</option>
                                <option value="54">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Feature }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option
                                    value="9,10,11,12,55,56,57,58,71,83,88,99,117,118,119,120,121,122,123,124,125,126,127,128">
                                    {{ $lng->All }}</option>
                                <option value="9,55,117,123">{{ $lng->View }}</option>
                                <option value="10,56,88,99,118,121,124,127">{{ $lng->Create }}</option>
                                <option value="11,57,71,83,119,122,125,128">{{ $lng->Edit }}</option>
                                <option value="12,58,120,126">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Role }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="100,101,102,103,104,105">{{ $lng->All }}</option>
                                <option value="100">{{ $lng->View }}</option>
                                <option value="101,104">{{ $lng->Create }}</option>
                                <option value="102,105">{{ $lng->Edit }}</option>
                                <option value="103">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Product }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="106,107,108,109,110,111,167,168,169,170,171,172,173,186,187,195,196,197,198,199,200">{{ $lng->All }}
                                </option>
                                <option value="106,167,168,186,195">{{ $lng->View }}</option>
                                <option value="107,110,196,198">{{ $lng->Create }}</option>
                                <option value="108,111,170,173,197,199">{{ $lng->Edit }}</option>
                                <option value="109,171,187,200">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Order }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="112,113,114,115,116">{{ $lng->All }}</option>
                                <option value="112.113">{{ $lng->View }}</option>
                                <option value="114,116">{{ $lng->Edit }}</option>
                                <option value="115">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Ticket }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="135,136,137,138,139,140,141,142,143,144,145,146">{{ $lng->All }}</option>
                                <option value="135,141">{{ $lng->View }}</option>
                                <option value="137,140,143,146">{{ $lng->Edit }}</option>
                                <option value="138,144">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Affiliation }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="147,148,149,150,151,152">{{ $lng->All }}</option>
                                <option value="147">{{ $lng->View }}</option>
                                <option value="149,152">{{ $lng->Edit }}</option>
                                <option value="150">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Language }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="153,154,155,156,157,158,159">{{ $lng->All }}</option>
                                <option value="153,154">{{ $lng->View }}</option>
                                <option value="155,158">{{ $lng->Create }}</option>
                                <option value="156,159">{{ $lng->Edit }}</option>
                                <option value="157">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->ShippingMethod }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="160,161,162,163,164,165,166">{{ $lng->All }}</option>
                                <option value="160,161">{{ $lng->View }}</option>
                                <option value="162,165">{{ $lng->Create }}</option>
                                <option value="163,166">{{ $lng->Edit }}</option>
                                <option value="164">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->PaymentGateway }} </label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="174,175,176,177,178,179">{{ $lng->All }}</option>
                                <option value="174">{{ $lng->View }}</option>
                                <option value="175,178">{{ $lng->Create }}</option>
                                <option value="176,179">{{ $lng->Edit }}</option>
                                <option value="177">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $lng->Customer }}</label>
                            <select name="permission[]" class="select2 form-control" multiple="multiple"
                                data-placeholder="{{ $lng->Permissions }}" >
                                <option value="180,181,184">{{ $lng->All }}</option>
                                <option value="180">{{ $lng->View }}</option>
                                <option value="181">{{ $lng->Edit }}</option>
                                <option value="184">{{ $lng->Delete }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $("#permission-wrapper").removeClass('d-none');
            $('.select2').select2()
        })

    </script>
@endsection

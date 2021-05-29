@extends('layouts.admin',['headerText' => "$lng->Edit"." $lng->Role"])
@section('title', "$lng->Edit"." $lng->Role") 
@section('style')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor/select2.min.css">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <i class="ri-arrow-right-s-line"></i>
        <a href="#">{{$lng->Edit}} {{$lng->Role}}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <form   method="post" action="{{route('role.update',$role->id)}}" class="ts__product__upload" enctype="multipart/form-data">
           @csrf
           @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="flex-item  top-info-header">
                        <div>
                        <a href="{{route('role.index')}}" class="list-btn">{{$lng->SeeList}}</a>
                        </div>
                       <div>
                            <input type="submit" value="{{$lng->Save}}" class="submit-btn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Name}} <span>*</span></label>
                    <input value="{{$role->name}}" name="name" required type="text" class="form-control" placeholder="Enter role name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >Label</label>
                        <input value="{{$role->label}}" name="label" type="text" class="form-control" placeholder="Enter role label">
                    </div>
                </div>
            </div>
          <div id="permission-wrapper" class="d-none">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Category}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("1", $permissions)&&in_array("2", $permissions)&&in_array("3", $permissions)&&in_array("4", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="1,2,3,4,59,60,61,62,63,64,65,66,67,68,69,84,85,86">{{$lng->All}}</option>
                            <option
                            @if (in_array("1", $permissions)&&!$all)
                                selected
                            @endif
                            value="1,59,63">{{$lng->View}}</option>
                            <option
                            @if (in_array("2", $permissions)&&!$all)
                                selected
                            @endif
                            value="2,60,64,84,85,86">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("3", $permissions)&&!$all)
                                selected
                            @endif
                            value="3,61,65,67,68,69">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("4", $permissions)&&!$all)
                                selected
                            @endif
                            value="4,62,66">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Brand}}</label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("5", $permissions)&&in_array("6", $permissions)&&in_array("7", $permissions)&&in_array("8", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="5,6,7,8,70,87">{{$lng->All}}</option>
                            <option
                            @if (in_array("5", $permissions)&&!$all)
                                selected
                            @endif
                            value="5">{{$lng->View}}</option>
                            <option
                            @if (in_array("6", $permissions)&&!$all)
                                selected
                            @endif
                            value="6,87">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("7", $permissions)&&!$all)
                                selected
                            @endif
                            value="7,70">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("8", $permissions)&&!$all)
                                selected
                            @endif
                            value="8">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Badge}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("13", $permissions)&&in_array("14", $permissions)&&in_array("15", $permissions)&&in_array("16", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="13,14,15,16,72,89">{{$lng->All}}</option>
                            <option
                            @if (in_array("13", $permissions)&&!$all)
                                selected
                            @endif
                            value="13">{{$lng->View}}</option>
                            <option
                            @if (in_array("14", $permissions)&&!$all)
                                selected
                            @endif
                            value="14,89">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("15", $permissions)&&!$all)
                                selected
                            @endif
                            value="15,72">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("16", $permissions)&&!$all)
                                selected
                            @endif
                            value="16">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Coupon}}</label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("17", $permissions)&&in_array("18", $permissions)&&in_array("19", $permissions)&&in_array("20", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="17,18,19,20,73,90">{{$lng->All}}</option>
                            <option
                            @if (in_array("17", $permissions)&&!$all)
                                selected
                            @endif
                            value="17">{{$lng->View}}</option>
                            <option
                            @if (in_array("18", $permissions)&&!$all)
                                selected
                            @endif
                            value="18,90">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("19", $permissions)&&!$all)
                                selected
                            @endif
                            value="19,73">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("20", $permissions)&&!$all)
                                selected
                            @endif
                            value="20">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Currency}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("21", $permissions)&&in_array("22", $permissions)&&in_array("23", $permissions)&&in_array("24", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="21,22,23,24,74,91">{{$lng->All}}</option>
                            <option
                            @if (in_array("21", $permissions)&&!$all)
                                selected
                            @endif
                            value="21">{{$lng->View}}</option>
                            <option
                            @if (in_array("22", $permissions)&&!$all)
                                selected
                            @endif
                            value="22,91">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("23", $permissions)&&!$all)
                                selected
                            @endif
                            value="23,74">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("24", $permissions)&&!$all)
                                selected
                            @endif
                            value="24">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->FlashSale}}</label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("25", $permissions)&&in_array("26", $permissions)&&in_array("27", $permissions)&&in_array("28", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="25,26,27,28,75,92,189,190,191,192,193,194">{{$lng->All}}</option>
                            <option
                            @if (in_array("25", $permissions)&&!$all)
                                selected
                            @endif
                            value="25,189">{{$lng->View}}</option>
                            <option
                            @if (in_array("26", $permissions)&&!$all)
                                selected
                            @endif
                            value="26,92,190,193">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("27", $permissions)&&!$all)
                                selected
                            @endif
                            value="27,75,191,194">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("28", $permissions)&&!$all)
                                selected
                            @endif
                            value="28,192">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Page}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("29", $permissions)&&in_array("30", $permissions)&&in_array("31", $permissions)&&in_array("32", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="29,30,31,32,76,93,129,130,131,132,133,134">{{$lng->All}}</option>
                            <option
                            @if (in_array("29", $permissions)&&!$all)
                                selected
                            @endif
                            value="29,129">{{$lng->View}}</option>
                            <option
                            @if (in_array("30", $permissions)&&!$all)
                                selected
                            @endif
                            value="30,93,130,133">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("31", $permissions)&&!$all)
                                selected
                            @endif
                            value="31,76,131,134">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("32", $permissions)&&!$all)
                                selected
                            @endif
                            value="32,132">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Report}}</label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            <option
                            @if (in_array("33", $permissions))
                                selected
                            @endif
                            value="33">{{$lng->View}}</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Setting}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            <option 
                            @if (in_array("34", $permissions))
                                selected
                            @endif
                            value="34,77">{{$lng->Edit}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Slider}}</label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("35", $permissions)&&in_array("36", $permissions)&&in_array("37", $permissions)&&in_array("38", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="35,36,37,38,78,94">{{$lng->All}}</option>
                            <option
                            @if (in_array("35", $permissions)&&!$all)
                                selected
                            @endif
                            value="35">{{$lng->View}}</option>
                            <option
                            @if (in_array("36", $permissions)&&!$all)
                                selected
                            @endif
                            value="36,94">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("37", $permissions)&&!$all)
                                selected
                            @endif
                            value="37,78">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("38", $permissions)&&!$all)
                                selected
                            @endif
                            value="38">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Tag}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("39", $permissions)&&in_array("40", $permissions)&&in_array("41", $permissions)&&in_array("42", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="39,40,41,42,79,95">{{$lng->All}}</option>
                            <option
                            @if (in_array("39", $permissions)&&!$all)
                                selected
                            @endif
                            value="39">{{$lng->View}}</option>
                            <option
                            @if (in_array("40", $permissions)&&!$all)
                                selected
                            @endif
                            value="40,95">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("41", $permissions)&&!$all)
                                selected
                            @endif
                            value="41,79">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("42", $permissions)&&!$all)
                                selected
                            @endif
                            value="42">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Withdraw}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("182", $permissions)&&in_array("183", $permissions))
                            selected
                            @php($all=true)   
                             @endif
                            value="182,183,185">{{$lng->All}}</option>
                            <option
                            @if (in_array("182", $permissions)&&!$all)
                            selected
                            @endif
                            value="182">{{$lng->View}}</option>
                            <option
                            @if (in_array("183", $permissions)&&!$all)
                            selected
                            @endif
                            value="183">{{$lng->Edit}}</option>
                            <option
                            @if (in_array("185", $permissions)&&!$all)
                            selected
                            @endif
                            value="185">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->User}} </label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("47", $permissions)&&in_array("48", $permissions)&&in_array("49", $permissions)&&in_array("50", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="47,48,49,50,81,97,188">{{$lng->All}}</option>
                            <option
                            @if (in_array("47", $permissions)&&!$all)
                                selected
                            @endif
                            value="47,188">{{$lng->View}}</option>
                            <option
                            @if (in_array("48", $permissions)&&!$all)
                                selected
                            @endif
                            value="48">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("49", $permissions)&&!$all)
                                selected
                            @endif
                            value="49,97">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("50", $permissions)&&!$all)
                                selected
                            @endif
                            value="50,81">{{$lng->Delete}}</option>
                          </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Blog}}</label>
                        <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("51", $permissions)&&in_array("52", $permissions)&&in_array("53", $permissions)&&in_array("54", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="51,52,53,54,82,98">{{$lng->All}}</option>
                            <option
                            @if (in_array("51", $permissions)&&!$all)
                                selected
                            @endif
                            value="51">{{$lng->View}}</option>
                            <option
                            @if (in_array("52", $permissions)&&!$all)
                                selected
                            @endif
                            value="52,98">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("53", $permissions)&&!$all)
                                selected
                            @endif
                            value="53,82">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("54", $permissions)&&!$all)
                                selected
                            @endif
                            value="54">{{$lng->Delete}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >{{$lng->Feature}} </label>
                          <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                            @php($all=false)
                            <option
                            @if (in_array("9", $permissions)&&in_array("10", $permissions)&&in_array("11", $permissions)&&in_array("12", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                            value="9,10,11,12,55,56,57,58,71,83,88,99,117,118,119,120,121,122,123,124,125,126,127,128">{{$lng->All}}</option> 
                            <option
                            @if (in_array("9", $permissions)&&!$all)
                                selected
                            @endif
                            value="9,55,117,123">{{$lng->View}}</option>
                            <option
                            @if (in_array("10", $permissions)&&!$all)
                                selected
                            @endif
                            value="10,56,88,99,118,121,124,127">{{$lng->Create}}</option>
                            <option 
                            @if (in_array("11", $permissions)&&!$all)
                                selected
                            @endif
                            value="11,57,71,83,119,122,125,128">{{$lng->Edit}}</option>
                            <option  
                            @if (in_array("12", $permissions)&&!$all)
                                selected
                            @endif
                            value="12,58,120,126">{{$lng->Delete}}</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Role}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("100", $permissions)&&in_array("101", $permissions)&&in_array("102", $permissions)&&in_array("103", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                                value="100,101,102,103,104,105">{{$lng->All}}</option>
                                <option
                                @if (in_array("100", $permissions)&&!$all)
                                selected
                            @endif
                                value="100">{{$lng->View}}</option>
                                <option
                                @if (in_array("101", $permissions)&&!$all)
                                selected
                            @endif
                                value="101,104">{{$lng->Create}}</option>
                                <option
                                @if (in_array("102", $permissions)&&!$all)
                                selected
                            @endif
                                value="102,105">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("103", $permissions)&&!$all)
                                selected
                            @endif
                                value="103">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Product}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("106", $permissions)&&in_array("107", $permissions)&&in_array("108", $permissions)&&in_array("109", $permissions))
                                selected
                                @php($all=true)   
                                @endif
                                value="106,107,108,109,110,111,167,168,169,170,171,172,173,186,187,195,196,197,198,199,200">{{$lng->All}}</option>
                                <option
                                @if (in_array("106", $permissions)&&!$all)
                                selected
                            @endif
                                value="106,167,168,186,195">{{$lng->View}}</option>
                                <option
                                @if (in_array("107", $permissions)&&!$all)
                                selected
                            @endif
                                value="107,110,196,198">{{$lng->Create}}</option>
                                <option
                                @if (in_array("108", $permissions)&&!$all)
                                selected
                            @endif
                                value="108,111,170,173,197,199">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("109", $permissions)&&!$all)
                                selected
                            @endif
                                value="109,171,187,200">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Order}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("112", $permissions)&&in_array("114", $permissions)&&in_array("115", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                                value="112,113,114,115,116">{{$lng->All}}</option>
                                <option
                                @if (in_array("112", $permissions)&&!$all)
                                selected
                            @endif
                                value="112,113">{{$lng->View}}</option>
                                <option
                                @if (in_array("114", $permissions)&&!$all)
                                selected
                            @endif
                                value="114,116">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("115", $permissions)&&!$all)
                                selected
                            @endif
                                value="115">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Ticket}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("135", $permissions)&&in_array("137", $permissions)&&in_array("138", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                                value="135,136,137,138,139,140,141,142,143,144,145,146">{{$lng->All}}</option>
                                <option
                                @if (in_array("135", $permissions)&&!$all)
                                selected
                            @endif
                                value="135,141">{{$lng->View}}</option>
                                <option
                                @if (in_array("137", $permissions)&&!$all)
                                selected
                            @endif
                                value="137,140,143,146">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("138", $permissions)&&!$all)
                                selected
                            @endif
                                value="138,144">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Affiliation}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("147", $permissions)&&in_array("149", $permissions)&&in_array("150", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                                value="147,148,149,150,151,152">{{$lng->All}}</option>
                                <option
                                @if (in_array("147", $permissions)&&!$all)
                                selected
                            @endif
                                value="147">{{$lng->View}}</option>
                                <option
                                @if (in_array("149", $permissions)&&!$all)
                                selected
                            @endif
                                value="149,152">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("150", $permissions)&&!$all)
                                selected
                            @endif
                                value="150">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Language}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("153", $permissions)&&in_array("155", $permissions)&&in_array("156", $permissions)&&in_array("157", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                                value="153,154,155,156,157,158,159">{{$lng->All}}</option>
                                <option
                                @if (in_array("153", $permissions)&&!$all)
                                selected
                            @endif
                                value="153,154">{{$lng->View}}</option>
                                <option
                                @if (in_array("155", $permissions)&&!$all)
                                selected
                            @endif
                                value="155,158">{{$lng->Create}}</option>
                                <option
                                @if (in_array("156", $permissions)&&!$all)
                                selected
                            @endif
                                value="156,159">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("157", $permissions)&&!$all)
                                selected
                            @endif
                                value="157">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->ShippingMethod}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("160", $permissions)&&in_array("162", $permissions)&&in_array("163", $permissions)&&in_array("164", $permissions))
                                selected
                             @php($all=true)   
                            @endif
                                value="160,161,162,163,164,165,166">{{$lng->All}}</option>
                                <option
                                @if (in_array("160", $permissions)&&!$all)
                                selected
                            @endif
                                value="160,164">{{$lng->View}}</option>
                                <option
                                @if (in_array("162", $permissions)&&!$all)
                                selected
                            @endif
                                value="162,165">{{$lng->Create}}</option>
                                <option
                                @if (in_array("163", $permissions)&&!$all)
                                selected
                            @endif
                                value="163,166">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("164", $permissions)&&!$all)
                                selected
                            @endif
                                value="164">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->PaymentGateway}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("174", $permissions)&&in_array("175", $permissions)&&in_array("176", $permissions)&&in_array("177", $permissions))
                                selected
                                @php($all=true)   
                                 @endif
                                value="174,175,176,177,178,179">{{$lng->All}}</option>
                                <option
                                @if (in_array("174", $permissions)&&!$all)
                                selected
                                @endif
                                value="174">{{$lng->View}}</option>
                                <option
                                @if (in_array("175", $permissions)&&!$all)
                                selected
                                @endif
                                value="175,178">{{$lng->Create}}</option>
                                <option
                                @if (in_array("176", $permissions)&&!$all)
                                selected
                                @endif
                                value="176,179">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("177", $permissions)&&!$all)
                                selected
                                @endif
                                value="177">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{$lng->Customer}} </label>
                            <select  name="permission[]" class="select2 form-control" multiple="multiple" data-placeholder="Select permissions" >
                                @php($all=false)
                                <option
                                @if (in_array("180", $permissions)&&in_array("181", $permissions)&&in_array("184", $permissions))
                                selected
                                @php($all=true)   
                                 @endif
                                value="180,181,184">{{$lng->All}}</option>
                                <option
                                @if (in_array("180", $permissions)&&!$all)
                                selected
                                @endif
                                value="180">{{$lng->View}}</option>
                                <option
                                @if (in_array("181", $permissions)&&!$all)
                                selected
                                @endif
                                value="181">{{$lng->Edit}}</option>
                                <option
                                @if (in_array("184", $permissions)&&!$all)
                                selected
                                @endif
                                value="184">{{$lng->Delete}}</option>
                              </select>
                        </div>
                    </div>
                  </div>
                </div>
          </div>



        </form>
    </div>
@endsection
@section('script')
    <!-- Select2 -->
<script src="{{asset('assets/admin/js/vendor/select2.full.min.js')}}"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $("#permission-wrapper").removeClass("d-none");
    $('.select2').select2()
})
</script>
@endsection
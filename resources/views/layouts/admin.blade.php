<!doctype html>
<html lang="en">
<head>
    <title>
        @hasSection('title')
            @yield('title')
            -{{ $setting->title }}
        @else
        @endif
    </title>
    <link rel="icon" href="{{ URL::to('/images/banner/' . $setting->favicon) }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/vendor/vendor-plugin.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/adminmaster.css">
    @yield('style')
</head>
<body>
    <div class="body-overlay"></div>
    <div class="top-section"></div>
    <div class="ts-container">
        @include('includes.admin.aside')
        <div class="d-none" id="admin-loader"><img alt="loader" class="loader__image"
                src="{{ asset('images/banner/' . $setting->admin_loader) }}"></div>
        <div class="content-section">
            <div class="content-wrapper">
                @include('includes.admin.header',['headerText' => $headerText])
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-section">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL::to('/admin') }}">{{ $lng->Dashboard }}</a>
                                </li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
            @include('includes.admin.footer')
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/promise.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/toastr.min.js') }}"></script>
    @yield('script')
    <script>
        $(function() {
          $(".notification-link").on('click',function(){
            redirectUrl=$(this).data("url");
            $.ajax({
              url: "{{URL::to('/')}}/notification/read/" + $(this).data("id"),
              type: 'GET',
            }).always(function (data) {
                window.location.href=redirectUrl
            })
          });
          @if(Session::has('success'))
            toastr.success( "{{ Session::get('success') }}");
          @endif
          @if(Session::has('error'))
            toastr.error( "{{ Session::get('error') }}");
          @endif
        })
        var adminUrl = "{{ URL::to('/admin') }}";
        var lng = {!!json_encode($lng) !!};
    </script>
    <script src="{{ asset('assets/admin/js/adminmaster.js') }}"></script>
</body>
</html>

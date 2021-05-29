
    @extends(['layouts.front','errors::minimal','errors::minimal','errors::minimal','errors::minimal','errors::minimal'][count(explode(".", request()->getRequestUri()))-1])
    @if(count(explode(".", request()->getRequestUri()))==1)
    @section('title', "$lng->_404NotFound")
    @section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col"><img src="{{asset('images/banner/'.$setting->banner_404)}}"/></div>
        </div>
    </div>
    @endsection 

    @else
    @section('title', __('Not Found'))
    @section('code', '404')
    @section('message', __('Not Found'))
    

    @endif


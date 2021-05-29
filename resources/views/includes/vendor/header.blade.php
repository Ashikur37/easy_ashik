<nav class="top-header navbar navbar-expand">
    <div class="d-lg-none">
      <span class="sidebar-trigger"> <i class="ri-menu-line"></i></span>
    </div>
  <h5 class="d-none d-lg-block">{{$headerText}}</h5> 
    <ul class="ml-auto navbar-nav">
        <li class="nav-item dropdown front-btn">
          <a class="nav-link" href="{{route('home')}}" target='_blank'>
            <i class="ri-earth-line"></i>
          </a> 
        </li>
        <li class="nav-item dropdown notification-btn">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="ri-notification-3-line"></i> 
            <span class="notification__indicator">{{auth()->user()->unreadNotifications()->count()}}</span>
          </a> 
          <div class="dropdown-menu dropdown-menu-right dropdown-notification p-sm-3 p-2">
          <h5>{{$lng->Notification}}</h5>
              @foreach(auth()->user()->notifications->take(3) as $notification)
              <a href="#" class="notification-link" data-url="{{$notification->data["link"]}}" data-id="{{$notification->id}}">
                <div class="p-3 notification-content-wrapper">
                  <div class="d-flex">
                      <img src="{{asset('icons/'.$notification->data["icon"])}}" alt="icon">
                      <div class="notification-content overflow-hidden">
                      <h6 class="mb-0 {{$notification->read_at?'seen':''}} text-truncate">{{$notification->data["title"]}}</h6>
                        <p class="mb-0 {{$notification->read_at?'seen':''}}">
                          {!!Str::limit($notification->data["text"],200)!!}</p>
                      </div>
                  </div>
                  <div class="notification-time">
                    <span class="{{$notification->read_at?'seen':''}}">{{$notification->created_at->diffForHumans(null, true,true)}}</span>
                    <span class="notification-status {{$notification->read_at?'seen':'unseen'}}"></span> 
                  </div>
                </div>
              </a>
              @endforeach
              <div class="text-center all-notification-link">
                 <a href="{{URL::to('/admin/notifications')}}">{{$lng->ViewAll}}</a>
              </div>
          </div>
        </li>
        <li class="nav-item dropdown profile-btn">
          <a class="nav-link dropdown-toggle pr-0" href="#" data-toggle="dropdown">
          <img class="rounded-circle avatar-sm" src="{{asset('images/user/'.auth()->user()->avatar)}}" alt="image" onerror="this.onerror=null;this.src='{{asset('images/avatar.png')}}'"></a>
          <div class="dropdown-menu dropdown-menu-right dropdown-profile">
            <div class="dropdown-header">
              <div class="overflow-hidden">
                <p class="mt-1 mb-0 text-left name text-truncate">{{auth()->user()->name}}</p>
                <p class="mb-0 email">{{auth()->user()->email}}</p>
              </div>
              <div>
              <img class="rounded-circle avatar-md" src="{{asset('images/user/'.auth()->user()->avatar)}}" alt="Profile image" onerror="this.onerror=null;this.src='{{asset('images/avatar.png')}}'">
              </div>
            </div> 
            <div class="pt-2">
            <a href="{{URL::to('/admin/profile')}}" class="dropdown-item"><i class="ri-user-line"></i>My Profile</a>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ri-logout-box-r-line"></i> {{$lng->SignOut}}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  {{ csrf_field() }}
              </form>
            </div>
          </div>
        </li>
      </ul>
</nav>

            
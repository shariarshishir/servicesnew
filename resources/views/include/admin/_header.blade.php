<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto admin-notification-dropdown">
      <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{count($notifications)}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header" style="color: #55a860;">You have {{count($notifications)}} Notifications</span>
            <div class="dropdown-order"></div>
            @foreach($notifications as $notification)
            @if($notification->type == 'App\Notifications\NewOrderHasPlacedNotification')
            <a href="{{route('vendor.order.show.notification',['vendor'=>$notification->data['order']['vendor_id'],'order'=>$notification->data['order']['order_number'],'notification'=>$notification->id])}}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>
                <div class="admin-notification-content">
                  <div class="admin-notification-title">{{$notification->data['title']}}</div>
                  <div class="text-muted text-sm">{{$notification->created_at}}</div>
                </div>
            </a>
            @elseif ($notification->type == 'App\Notifications\OrderQueryNotification' )
            <a href="{{ url($notification->data['url']) }}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>
                <div class="admin-notification-content">
                  <div class="admin-notification-title">{{$notification->data['title']}}</div>
                  <div class="text-muted text-sm">{{$notification->created_at}}</div>
                </div>
            </a>
            @elseif ($notification->type == 'App\Notifications\NewOrderModificationRequestNotification' )
            <a href="{{ $notification->data['url'] }}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>
                <div class="admin-notification-content">
                  <div class="admin-notification-title">{{$notification->data['title']}}</div>
                  <div class="text-muted text-sm">{{$notification->created_at}}</div>
                </div>
            </a>
            @elseif ($notification->type == 'App\Notifications\QueryCommuncationNotification' )
            <a href="{{ $notification->data['url'] }}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>
                <div class="admin-notification-content">
                  <div class="admin-notification-title">{{$notification->data['title']}}</div>
                  <div class="text-muted text-sm">{{$notification->created_at}}</div>
                </div>
            </a>
            @elseif ($notification->type == 'App\Notifications\PaymentSuccessNotification')
            <a href="{{ $notification->data['url'] }}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>
                <div class="admin-notification-content">
                  <div class="admin-notification-title">{{$notification->data['title']}}</div>
                  <div class="text-muted text-sm">{{$notification->created_at}}</div>
                </div>
            </a>
            @endif

            @endforeach

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
      <li class="nav-item menu-items">
        <a href="{{ route('admin.logout') }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">

          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Logout</span>
      </a>
      <form id="frm-logout" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
      </li>
    </ul>
  </nav>

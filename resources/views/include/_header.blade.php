@php
$priceChart = json_decode(file_get_contents('https://www.merchantbay.com/api/price-chart'), true);
@endphp
<!-- Header Layouts Start -->
<header class="desktopHeader">
    <div class="row">
        <div class="top-header">
            <div class="container">
                <div class="follow-the-price-chart">
                    <h5>Follow the price :</h5>
                    <table class="table dtable" style="width: 700px;">
                        <tbody id="horizontalmarque">
                            @if(!empty($priceChart))
                            @foreach($priceChart['pricingChartList'] as $priceItem)
                            <tr style="display: none;" class="animate__animated animate__fadeIn animate__slow">
                                <td>{{ $priceItem['name'] }}</td>
                                <td>Last: {{ $priceItem['last_price'] }}</td>
                                <td>Today: ${{ $priceItem['today_price'] }}</td>
                                <td>MOQ: {{ $priceItem['moq'] }} {{ $priceItem['unit'] }}</td>
                                <td style="width: 1%;background: none;text-align: right;"><a href="#rfqFormModal" data-toggle="modal" data-item="{&quot;id&quot;:5,&quot;category_id&quot;:12,&quot;name&quot;:&quot;30\/1 (CARDED) KH&quot;,&quot;last_price&quot;:&quot;0.00&quot;,&quot;today_price&quot;:&quot;4.20&quot;,&quot;moq&quot;:3,&quot;currency&quot;:&quot;USD&quot;,&quot;unit&quot;:&quot;ton&quot;,&quot;created_at&quot;:&quot;2020-03-01 19:52:49&quot;,&quot;updated_at&quot;:&quot;2021-07-13 11:50:31&quot;}" class="btn-enquiry"><span>Enquiry</span></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="middle-header">
            <div class="container middle-header-container">
                <div class="col m3">&nbsp;</div>
                <div class="col m9">
                    <div class="top-menu">
                        <ul>
                            @if(Auth::guard('web')->check() && Cookie::has('sso_token') )
                               <form action="{{env('MANUFACTURE_BASE_URL').'/login-from-shop'}}" method="get" id="submit-to-manufacturers-form">

                                    <input type="hidden" name="email" value="{{auth()->user()->email}}">
                                    <input type="hidden" name="password" value="{{session('sso_password')}}">
                                    <li><a href="#" class="submit-to-manufacturers">Manufacturers</a></li>
                               </form>
                            @else
                                <li><a href="https://www.merchantbay.com/">Manufacturers</a></li>
                            @endif
                            <li class="active"><a href="https://shop.merchantbay.com/">Shop</a></li>
                            <li><a href="https://tools.merchantbay.com/">Tools</a></li>
                            <li><a href="http://insight.merchantbay.com/">Insights</a></li>
                            <li><a href="https://www.merchantbay.com/3d-studio">3D Studio</a></li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-trigger" data-target="dropdown1">
                                    Others <span><i class="material-icons dp48">expand_more</i></span>
                                </a>
                                <ul id="dropdown1" class="dropdown-content">
                                    <li><a href="javascript:void(0);">Trade security</a></li>
                                    <li><a href="javascript:void(0);">Logistic Service</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="user-menu">
                        <ul>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-trigger" data-target="dropdown2">
                                    Helps <span><i class="material-icons dp48">expand_more</i></span>
                                </a>
                                <ul id="dropdown2" class="dropdown-content">
                                    <li><a href="javascript:void(0);">FAQ</a></li>
                                    <li><a href="javascript:void(0);">For Buyers</a></li>
                                    <li><a href="javascript:void(0);">For suppliers</a></li>
                                    <li><a href="javascript:void(0);">Contact / Submit a dispute</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Blogs</a>
                            </li>
                        </ul>
                    </div>
                    <div class="cart-icon-outer-wrapper">
                        <div class="cart-icon-wrapper">
                            <a href="javascript:void(0);" class="btn waves-effect waves-light green lighten-1 cart-btn">
                                <i class="material-icons dp48">shopping_cart</i>
                                <span id="cartItems"class="cart_counter">{{$cartItems}}</span>
                            </a>
                            <ul id="cart-dropdown" class="card" style="display: none;">
                                {{-- @if(Cart::content()->count() > 0) --}}

                                <li tabindex="0">
                                    <a class="grey-text text-darken-1" href="{{route('cart.index')}}"><i class="material-icons">shopping_basket</i> My Cart</a>
                                </li>
                                <li tabindex="0">
                                    <a class="grey-text text-darken-1" href="{{route('cart.destroy')}}"><i class="material-icons">delete</i> Delete all cart item</a>
                                </li>
                                {{-- @else
                                <li tabindex="0">
                                    <a class="grey-text text-darken-1" href="javascript:void(0);"><i class="material-icons">shopping_basket</i> Basket is empty</a>
                                </li>
                                @endif --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header">

            <div class="container">
                <div class="main-header-inside row">
                    <div class="col m3">
                        <div class="logo">
                            <a href="{{route('home')}}"><img src="{{asset('images/frontendimages/logo.png')}}" alt="Merchant Bay Logo" /></a>
                        </div>
                    </div>
                    <div class="col m9 desktop-header-right-side">

                        <div class="header-bottom-block">
                            @php
                                $searchType= request()->get('search_type');
                            @endphp

                            <div class="module-search">
                                <select id="searchOption" class="select2 browser-default select-search-type">
                                    <option value="product" name="search_key" {{ $searchType=="product" ? 'selected' : '' }}>Products</option>
                                    <option value="vendor"  name="search_key" {{ $searchType=="vendor" ? 'selected' : '' }}>Stores</option>
                                </select>
                                <form name="system_search" action="{{route('onsubmit.search')}}" id="system_search" method="get">
                                    @if(Route::is('onsubmit.search'))
                                    <input type="text" placeholder="Type products name" value="{{$searchInputValue}}" class="search_input"  name="search_input"/>
                                    @else
                                    <input type="text" placeholder="Type products name" value="" class="search_input"  name="search_input"/>
                                    @endif
                                    <input type="hidden" name="search_type" class="search_type" value="" />
                                    <button class="btn waves-effect waves-light green darken-1 search-btn" type="submit" ><i class="material-icons dp48">search</i></button>
                                </form>
                                <div id="search-results" style="display: none;"></div>
                            </div>
                            @if(env('APP_ENV') == 'production')
                                <div class="other-access @php echo (Auth::guard('web')->check() && Cookie::has('sso_token'))?'user-authenticated':'user-not-authenticated'; @endphp">
                                    <a href="javascript:void(0);" class="btn waves-effect waves-light green darken-1 search-btn-trigger tooltipped" data-position="top" data-tooltip="Search">
                                        <i class="material-icons dp48">search</i>
                                    </a>
                                    <a href="https://www.merchantbay.com/create-rfq" class="btn waves-effect waves-light green darken-1 rfq-btn large-screen">RFQ</a>
                                </div>
                            @else
                                <div class="other-access @php echo (Auth::guard('web')->check())?'user-authenticated':'user-not-authenticated'; @endphp">
                                    <a href="javascript:void(0);" class="btn waves-effect waves-light green darken-1 search-btn-trigger tooltipped" data-position="top" data-tooltip="Search">
                                        <i class="material-icons dp48">search</i>
                                    </a>
                                    <a href="https://www.merchantbay.com/create-rfq" class="btn waves-effect waves-light green darken-1 rfq-btn large-screen">RFQ</a>
                                </div>
                            @endif

                            @if(env('APP_ENV') == 'production')
                                @if(Auth::guard('web')->check() && Cookie::has('sso_token'))
                                    <div class="notification-block-wrapper">
                                        <div class="notification-block">
                                            <a href="javascript:void(0)" class="btn notification-btn waves-effect waves-light green darken-1">
                                                <i class="material-icons dp48">notifications</i>
                                                <span id="noOfNotifications"class="notification-count">{{count($userNotifications)}}</span>
                                            </a>
                                            @if(count($userNotifications) > 0)
                                            <div class="notification-list card" style="display: none;">
                                                <ul>
                                                    @foreach($userNotifications as $userNotification)
                                                    <li>
                                                        <a href="{{URL::to($userNotification->data['url'])}}">
                                                            <i class="fas fa-envelope mr-2"></i>
                                                            <div class="notification-info">
                                                                <div class="notofication-title">{{$userNotification->data['title']}}</div>
                                                                <div class="notofication-date">{{$userNotification->created_at}}</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @else
                                            <div class="notification-list card" style="display: none;">
                                                No Notification found.
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if(Auth::guard('web')->check())
                                    <div class="notification-block-wrapper">
                                        <div class="notification-block">
                                            <a href="javascript:void(0)" class="btn notification-btn waves-effect waves-light green darken-1">
                                                <i class="material-icons dp48">notifications</i>
                                                <span id="noOfNotifications"class="notification-count">{{count($userNotifications)}}</span>
                                            </a>
                                            @if(count($userNotifications) > 0)
                                            <div class="notification-list card" style="display: none;">
                                                <ul>
                                                    @foreach($userNotifications as $userNotification)
                                                    <li>
                                                        <a href="{{URL::to($userNotification->data['url'])}}">
                                                            <i class="fas fa-envelope mr-2"></i>
                                                            <div class="notification-info">
                                                                <div class="notofication-title">{{$userNotification->data['title']}}</div>
                                                                <div class="notofication-date">{{$userNotification->created_at}}</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @else
                                            <div class="notification-list card" style="display: none;">
                                                No Notification found.
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="user-block">
                                @if(env('APP_ENV') == 'production')
                                        @if(Auth::guard('web')->check() && Cookie::has('sso_token'))
                                            <a href="javascript:void(0);" class="dropdown-trigger waves-effect waves-block waves-light" data-target="profile-dropdown">
                                                <span class="avatar-status avatar-online">
                                                    <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="avatar">
                                                </span>
                                            </a>
                                            <ul id="profile-dropdown" class="dropdown-content">
                                                <li tabindex="0">
                                                    <a class="grey-text text-darken-1" href="{{ route('users.profile') }}"><i class="material-icons">person_outline</i> Profile</a>
                                                </li>
                                                @if( auth()->user()->user_type!='buyer' )
                                                <li tabindex="0">
                                                    <a class="grey-text text-darken-1" href="{{route('users.myshop',Auth::user()->vendor->vendor_uid)}}"><i class="material-icons">store</i>My shop</a>
                                                </li>
                                                @endif
                                                <li tabindex="0">
                                                    <a class="grey-text text-darken-1" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> My favorite</a>
                                                </li>
                                                <li tabindex="0">
                                                    <a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
                                                </li>
                                            </ul>
                                            <form id="logout-form" action="{{ route('users.logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        @else
                                            <a href="#login-register-modal" class="btn waves-effect waves-light green darken-1 login-register-btn large-screen modal-trigger">Login / Register</a>
                                            {{-- <a href="http://dev.accounts.merchantbay.com/login?flag=shop" class="btn waves-effect waves-light green darken-1 login-register-btn large-screen modal-trigger">Login / Register</a> --}}
                                        @endif

                                @else
                                        @if(Auth::guard('web')->check())
                                        <a href="javascript:void(0);" class="dropdown-trigger waves-effect waves-block waves-light" data-target="profile-dropdown">
                                            <span class="avatar-status avatar-online">
                                                <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="avatar">
                                            </span>
                                        </a>
                                        <ul id="profile-dropdown" class="dropdown-content">
                                            <li tabindex="0">
                                                <a class="grey-text text-darken-1" href="{{ route('users.profile') }}"><i class="material-icons">person_outline</i> Profile</a>
                                            </li>
                                            @if( auth()->user()->user_type!='buyer' )
                                            <li tabindex="0">
                                                <a class="grey-text text-darken-1" href="{{route('users.myshop',Auth::user()->vendor->vendor_uid)}}"><i class="material-icons">store</i>My shop</a>
                                            </li>
                                            @endif
                                            <li tabindex="0">
                                                <a class="grey-text text-darken-1" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> My favorite</a>
                                            </li>
                                            <li tabindex="0">
                                                <a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
                                            </li>
                                        </ul>
                                        <form id="logout-form" action="{{ route('users.logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    @else
                                        <a href="#login-register-modal" class="btn waves-effect waves-light green darken-1 login-register-btn large-screen modal-trigger">Login / Register</a>
                                    @endif

                                @endif
                            </div>

                        </div>
                        <div class="header-top-block">
                            <div class="main-menu">
                                <ul>
                                    <li class="{{ Route::is('home') ? 'active' : ''}}">
                                        <a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="{{ Route::is('readystockproducts') ? 'active' : ''}}">
                                        <a href="{{route('readystockproducts')}}">Ready Stock</a>
                                    </li>
                                    <li class="{{ Route::is('buydesignsproducts') ? 'active' : ''}}">
                                        <a href="{{route('buydesignsproducts')}}">Designs</a>
                                    </li>
                                    <li class="{{ Route::is('vendors') ? 'active' : ''}}">
                                        <a href="{{route('vendors')}}">Suppliers</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>

<header class="mobileHeader">
    <div class="row">
        <div class="mobile-top-header">
            <div class="container">
                <div class="logo">
                    <a href="javascript:void(0);"><img src="{{asset('images/frontendimages/logo.png')}}" alt="Merchant Bay Logo" /></a>
                </div>
                <a href="javascript:void(0);" class="btn waves-effect waves-light green darken-1 mobile-search-btn search-btn-trigger">
                    <i class="material-icons dp48">search</i>
                </a>
                <a href="javascript:void(0);" class="btn waves-effect waves-light green darken-1 mobile-cart-btn">
                    <i class="material-icons dp48">shopping_cart</i>
                </a>
            </div>
            <div class="mobile-module-search" style="display: none;">
                <input type="text" placeholder="I am looking for ..." value="" class="search-input" />
                <button class="btn waves-effect waves-light green darken-1 search-btn" type="button" name="search">Search</button>
            </div>
        </div>

        <a class="waves-effect waves-block waves-light btn green darken-1 btn-floating btn-sidenav-left" href="javascript:void(0)" onclick="openSideNavFromLeft()">
            <i class="material-icons">menu</i>
        </a>
        <div id="SideNavFromLeft" class="sidenav-left">
            <a href="javascript:void(0)" class="sideNavCloseBtn" onclick="closeSideNavFromLeft()">&times;</a>
            <ul>
                <li class="{{ Route::is('home') ? 'active' : ''}}">
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li><a href="javascript:void(0);">Manufacturers</a></li>
                <li>
                    <a href="javascript:void(0);">Shop</a>
                    <ul>
                        <li class="{{ Route::is('readystockproducts') ? 'active' : ''}}">
                            <a href="{{route('readystockproducts')}}">Ready Stock</a>
                        </li>
                        <li class="{{ Route::is('buydesignsproducts') ? 'active' : ''}}">
                            <a href="{{route('buydesignsproducts')}}">Designs</a>
                        </li>
                        <li class="{{ Route::is('vendors') ? 'active' : ''}}">
                            <a href="{{route('vendors')}}">Suppliers</a>
                        </li>
                    </ul>
                </li>
                <li><a href="javascript:void(0);">Tools</a></li>
                <li><a href="javascript:void(0);">Insights</a></li>
                <li><a href="javascript:void(0);">3D Studio</a></li>
                <li>
                    <a href="javascript:void(0);">Helps</a>
                    <ul>
                        <li><a href="javascript:void(0);">FAQ</a></li>
                        <li><a href="javascript:void(0);">For Buyers</a></li>
                        <li><a href="javascript:void(0);">For Suppliers</a></li>
                        <li><a href="javascript:void(0);">Contact / Submit a dispute</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);">Others</a>
                    <ul>
                        <li><a href="javascript:void(0);">Trade Security</a></li>
                        <li><a href="javascript:void(0);">Logistic Service</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0);">Blogs</a></li>
            </ul>
        </div>

        <a href="#login-register-modal" class="btn waves-effect waves-light green darken-1 login-register-btn modal-trigger"><i class="material-icons">person</i></a>
        <a class="waves-effect waves-block waves-light btn green darken-1 btn-sidenav-right" href="javascript:void(0)" onclick="openSideNavFromRight()">
            <i class="material-icons">format_indent_increase</i>
        </a>
        <div id="SideNavFromRight" class="sidenav-right">
            <a href="javascript:void(0)" class="sideNavCloseBtn" onclick="closeSideNavFromRight()">&times;</a>
            <div class="mobile-follow-the-price-chart">
                <h5>Follow the price :</h5>
                <ul>
                    <li>100% Acrylic 2/32 Yarn</li>
                    <li>Last: $1.65</li>
                    <li>Today: $1.60 <span><i class="material-icons dp48">arrow_downward</i></span></li>
                    <li>MOQ: 100 pound</li>
                </ul>
                <a href="javascript:void(0);" class="btn-enquiry mb-6 btn waves-effect waves-light green lighten-1">Enquiry</a>
            </div>
        </div>
    </div>
</header>
<!-- Header Layouts End -->

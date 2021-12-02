<!-- Header section start -->
<section class="header_wrap sticky_header">
	<header class="header_dasktop">
		<div class="container">
			<div class="row header_innrer">
				<div class="col m5 mainnav_wrap">
					<nav class="mainNav">
						<ul class="left hide-on-med-and-down">
							<li>
								<a class="dropdown-trigger" href="javascript:void(0);" data-target="more-system-products">Products<i class="material-icons right">arrow_drop_down</i></a>
								<!-- Dropdown Structure -->
								<ul id="more-system-products" class="dropdown-content subNav">
									<li><a href="{{route('readystockproducts')}}">Ready Stock</a></li>
									<li><a href="{{route('buydesignsproducts')}}">New Designs</a></li>
									<li><a href="{{route('low.moq')}}">Low MOQ</a></li>
									<li><a href="{{route('shortest.lead.time')}}">Shortest Lead Time</a></li>
									<li><a href="{{route('customizable')}}">Customizablee</a></li>
								</ul>
							</li>
							<li><a href="{{route('suppliers')}}">Suppliers</a></li>
							<li><a href="javascript:void(0);">Tools</a></li>
							<li><a href="{{route('rfq.index')}}">RFQ</a></li>
							<li>
								<a class="dropdown-trigger" href="javascript:void(0);" data-target="more-system-links">More<i class="material-icons right">arrow_drop_down</i></a>
								<!-- Dropdown Structure -->
								<ul id="more-system-links" class="dropdown-content subNav">
									<li><a href="javascript:void(0);">Blogs</a></li>
									<li><a href="javascript:void(0);">Insights</a></li>
									<li><a href="javascript:void(0);">Helps</a></li>
									<li><a href="javascript:void(0);">FAQs</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
				<div class="col m2 logo"><a href="{{route('home')}}"><img src="{{asset('images/frontendimages/new_layout_images/logo.png')}}" alt="logo" /></a></div>
				<div class="col m5 top_right ">
					<a href="{{route('business.profile.create')}}" type="button" class="btn_profile btn_green">
					    <span class="material-icons"> assignment_ind </span> Business Profile
					</a>

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
									<li tabindex="0">
										<a class="grey-text text-darken-1" href="{{route('business.profile')}}"><i class="material-icons">store</i> My Business</a>
									</li>
									<li tabindex="0">
										<a class="grey-text text-darken-1" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> My favorite</a>
									</li>
									<li tabindex="0">
										<a class="grey-text text-darken-1" href="javascript:void(0);"><i class="material-icons">settings</i> Settings</a>
									</li>
									<li tabindex="0">
										<a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
									</li>
								</ul>
								<form id="logout-form" action="{{ route('users.logout') }}" method="POST">
									@csrf
								</form>
							@else
								<a href="#login-register-modal" class="btn_logRegi btn_white modal-trigger">Login / Register</a>
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
								<li tabindex="0">
									<a class="grey-text text-darken-1" href="{{route('business.profile')}}"><i class="material-icons">store</i> My Business</a>
								</li>
								<li tabindex="0">
									<a class="grey-text text-darken-1" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> My favorite</a>
								</li>
								<li tabindex="0">
									<a class="grey-text text-darken-1" href="javascript:void(0);"><i class="material-icons">settings</i> Settings</a>
								</li>
								<li tabindex="0">
									<a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
								</li>
							</ul>
							<form id="logout-form" action="{{ route('users.logout') }}" method="POST">
								@csrf
							</form>
							@else
								<a href="#login-register-modal" class="btn_logRegi btn_white modal-trigger">Login / Register</a>
							@endif

						@endif
					</div>


				</div>
			</div>
		</div>
	</header>
	<header class="mobile_header header_wrap">
		<div class="container">
			<div class="col m2 logo center-align"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/logo.png')}}" alt="logo" /></a></div>
			<div class="row">
				<div class="col s6 mainNav">
					<div id="slide-out" class="sidenav">
						<!-- <a href="javascript:void(0)" class="sideNavCloseBtn" onclick="closeSideNavFromLeft()">×</a> -->
						<ul>
							<li><a href="javascript:void(0);">Products</a></li>
							<li><a href="javascript:void(0);">Supliers</a></li>
							<li><a href="javascript:void(0);">RFQ</a></li>
							<li><a href="javascript:void(0);">Tools</a></li>
							<li>
								<ul class="subNav">
									<li><a href="javascript:void(0);">Blogs</a></li>
									<li><a href="javascript:void(0);">Insights</a></li>
									<li><a href="javascript:void(0);">Helps</a></li>
									<li><a href="javascript:void(0);">FAQs</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<a href="javascript:void(0);" data-target="slide-out" class="sidenav-trigger waves-effect waves-block waves-light btn green lighten-1 btn-floating btn-sidenav-left"><i class="material-icons">menu</i></a>
				</div>
				<div class="col s6 right-align mobile_top_right">
					<span class="material-icons"> assignment_ind </span>
					<span class="material-icons">login</span>
				</div>
			</div>
		</div>
	</header>
</section>
<!-- Header section end -->

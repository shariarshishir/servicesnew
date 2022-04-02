<!-- Header section start  -->
<section class="header_wrap sticky_header" itemscope>
	<div class="container" itemscope>
		<!-- Desktop header start -->
		<header class="header_dasktop" itemscope>
			<div class="row header_innrer" itemscope>
				<div class="col m5 mainnav_wrap" itemscope>
					<nav class="mainNav" itemscope>
						<ul class="left hide-on-med-and-down" itemscope itemtype="https://schema.org/ListItem">
                            <li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="Products" href="javascript:void(0);" data-target="studio-products">Studio<i class="material-icons right">arrow_drop_down</i></a>
								<!-- Dropdown Structure -->
								<ul id="studio-products" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a itemprop="Designs" href="{{route('product.type.mapping',['studio', 'design'])}}" class="{{ Route::is('products') ? 'active' : ''}}">Designs</a></li>
									<li itemprop="itemListElement"><a itemprop="Production Sample" href="{{route('product.type.mapping',['studio', 'product_sample'])}}" class="{{ Route::is('readystockproducts') ? 'active' : ''}}">Production Sample</a></li>
									<li itemprop="itemListElement"><a itemprop="Ready Stock" href="{{route('product.type.mapping',['studio', 'ready_stock'])}}" >Ready Stock</a></li>
								</ul>
							</li>
                            <li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="Products" href="javascript:void(0);" data-target="more-system-products">Raw Materials<i class="material-icons right">arrow_drop_down</i></a>
								<!-- Dropdown Structure -->
								<ul id="more-system-products" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a itemprop="Textile" href="{{route('product.type.mapping',['raw_materials', 'textile'])}}" class="{{ Route::is('products') ? 'active' : ''}}">Textile</a></li>
									<li itemprop="itemListElement"><a itemprop="Yarn" href="{{route('product.type.mapping',['raw_materials', 'yarn'])}}" class="{{ Route::is('readystockproducts') ? 'active' : ''}}">Yarn</a></li>
									<li itemprop="itemListElement"><a itemprop="Trims and Accessories" href="{{route('product.type.mapping',['raw_materials', 'trims_and_accessories'])}}" class="{{ Route::is('buydesignsproducts') ? 'active' : ''}}">Trims and Accessories</a></li>
								</ul>
							</li>
							<li itemprop="itemListElement"><a itemprop="RFQ" class="{{ Route::is('rfq.index') ? 'active' : ''}}" href="{{route('rfq.index')}}">RFQ</a></li>
							<li itemprop="itemListElement"><a itemprop="Suppliers" class="{{ Route::is('suppliers') ? 'active' : ''}}" href="{{route('suppliers')}}">Suppliers</a></li>
							<li itemprop="itemListElement"><a itemprop="Tools" class="{{ Route::is('front.tools') ? 'active' : ''}}" href="{{route('front.tools')}}">Tools</a></li>
							
							<li itemprop="itemListElement"><a href="{{route('industry.blogs')}}" itemprop="Blog" class="{{ Route::is('industry.blogs') ? 'active' : ''}}">Blogs</a></li>
							
							<!-- <li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="More" href="javascript:void(0);" data-target="more-system-links">More<i class="material-icons right">arrow_drop_down</i></a>
								
								<ul id="more-system-links" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a href="{{route('industry.blogs')}}" itemprop="Blog" class="{{ Route::is('industry.blogs') ? 'active' : ''}}">Blogs</a></li>
									<li itemprop="itemListElement"><a href="http://insight.merchantbay.com/" itemprop="Insights">Insights</a></li>
									<li itemprop="itemListElement" style="display: none;"><a href="javascript:void(0);" itemprop="Helps">Helps</a></li>
									<li itemprop="itemListElement" style="display: none;"><a href="javascript:void(0);" itemprop="FAQs">FAQs</a></li>
								</ul>
							</li> -->

						</ul>
					</nav>
				</div>
				<div class="col m2 logo" itemscope><a href="{{route('home')}}" itemprop="Merchantbay Home"><img itemprop="img" src="{{asset('images/frontendimages/new_layout_images/logo.png')}}" alt="logo" /></a></div>

				<div class="col m5 top_right " itemscope>
					<div class="user-block" itemscope>
						@if(env('APP_ENV') == 'production')
							@if(Auth::guard('web')->check() && Cookie::has('sso_token'))
								<a itemprop="Merchantbay Profile" href="javascript:void(0);" class="dropdown-trigger waves-effect waves-block waves-light" data-target="profile-dropdown">
									<span class="avatar-status avatar-online" itemprop="Merchantbay User avatar">
										@if(auth()->user()->image)
										<img src="{{ asset('storage/'.auth()->user()->image) }}" alt="avatar" itemprop="img">
										@else
										<img src="{{asset('images/frontendimages/no-image.png')}}" alt="avatar" itemprop="img">
										@endif
									</span>
								</a>
								<ul id="profile-dropdown" class="dropdown-content" itemscope itemtype="https://schema.org/ListItem">
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Merchantbay Profile" href="{{ route('users.profile') }}"><i class="material-icons">person_outline</i> Profile</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="My Business" href="{{route('business.profile')}}"><i class="material-icons">store</i> My Business</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Wishlist" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> Wishlist</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Settings" href="{{env('SSO_URL').'/profile'}}"><i class="material-icons">settings</i> Settings</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
									</li>
								</ul>
								<form id="logout-form" itemscope action="{{ route('users.logout') }}" method="POST">
									@csrf
								</form>
							@else
								<a href="#login-register-modal" itemprop="Login / Register" class="btn_logRegi btn_white modal-trigger">Login / Register</a>
							@endif

							@else
								@if(Auth::guard('web')->check())
								<a href="javascript:void(0);" itemscope class="dropdown-trigger waves-effect waves-block waves-light" data-target="profile-dropdown">
									<span class="avatar-status avatar-online" itemprop="Merchantbay User avatar">
										@if(auth()->user()->image)
										<img src="{{ asset('storage/'.auth()->user()->image) }}" itemprop="img" alt="avatar">
										@else
										<img src="{{asset('images/frontendimages/no-image.png')}}" itemprop="img" alt="avatar">
										@endif
									</span>
								</a>
								<ul id="profile-dropdown" class="dropdown-content card" itemscope itemtype="https://schema.org/ListItem">
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Merchantbay Profile" href="{{ route('users.profile') }}"><i class="material-icons">person_outline</i> Profile</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="My Business" href="{{route('business.profile')}}"><i class="material-icons">store</i> My Business</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Wishlist" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> Wishlist</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Settings" href="{{env('SSO_URL').'/profile'}}"><i class="material-icons">settings</i> Settings</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
									</li>
								</ul>
								<form id="logout-form" itemscope action="{{ route('users.logout') }}" method="POST">
									@csrf
								</form>
								@else
									<a href="#login-register-modal" itemprop="Login / Register" class="btn_logRegi btn_white modal-trigger">Login / Register</a>
							@endif

						@endif
					</div>

					@if(auth()->user())

					<div class="notifications_icon_wrap" itemscope>
						<a href="javascript:void(0);" class="dropdown-trigger" data-target="countdown-dropdown" itemprop="Message Notification">
							<i class="material-icons">notifications</i>
							@if(count($userNotifications) > 0)
							<span id="" class="noticication_counter">{{ count($userNotifications) }}</span>
							@endif
						</a>
					</div>

					<ul id="countdown-dropdown" class="dropdown-content card" itemscope itemtype="https://schema.org/ListItem">
						@if(count($userNotifications)>0)
						<li class="notifications-list" itemprop="itemListElement">
							@foreach($userNotifications as $notification)
								@if($notification->type == 'App\Notifications\NewOrderHasPlacedNotification')
								<a itemprop="New Order Notification" href="{{route('vendor.order.show.notification',['businessProfile'=>$notification->data['order']['business_profile_id'],'order'=>$notification->data['order']['order_number'],'notification'=>$notification->id])}}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif($notification->type == 'App\Notifications\NewOrderHasApprovedNotification')
								<a itemprop="New Order Approved Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\OrderQueryNotification' )
								<a itemprop="Order Query Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\OrderQueryFromAdminNotification' )
								<a itemprop="Order Query From Admin Notification" href="{{ url($notification->data['url']) }}">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>

								@elseif ($notification->type == 'App\Notifications\NewOrderModificationRequestNotification' )
								<a itemprop="New Order Modification Request Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\QueryCommuncationNotification' )
								<a itemprop="Query Communication Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\QueryWithModificationToUserNotification')
								<a itemprop="Query With Modification To User Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\PaymentSuccessNotification')
								<a itemprop="Payment Success Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type =='App\Notifications\NewRfqNotification')
								<a itemprop="New RFQ Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type =='App\Notifications\RfqBidNotification')
								<a itemprop="RFQ Bid Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content" itemscope>
										<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
										<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
									</div>
								</a>
								@endif
							@endforeach
						</li>
						@else
						<li class="no-notifications" itemprop="itemListElement">
							No notifications
						</li>
						@endif
					</ul>

					<div class="header_message_box" itemscope>
						<a href="{{route('message.center')}}" itemprop="Message Notification Count" class="message-center-dropdown-trigger" data-target="message-countdown-dropdown">
							<i class="material-icons">message</i>
							@if(count($messageCenterNotifications) > 0)
							<span class="sms_counter">{{ count($messageCenterNotifications) }}</span>
							@endif
						</a>

						<ul id="message-countdown-dropdown" class="dropdown-content card" itemscope itemtype="https://schema.org/ListItem">
							@if(count($userNotifications)>0)
								@foreach($userNotifications as $notification)
									@if($notification->type == 'App\Notifications\BuyerWantToContact')
									<li class="notifications-list" itemprop="itemListElement">
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="Buyer want to contact">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{ $notification->data['title'] }}"> {{ $notification->data['title'] }} </div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
									</li>
									@endif
								@endforeach
							@else
							<li class="no-notifications" itemprop="itemListElement">
								No notifications
							</li>
							@endif
						</ul>
					</div>

					@endif

					<a href="{{route('business.profile.create')}}" itemprop="Join MB Pool" type="button" class="btn_profile btn_green">
					     Join MB Pool
					</a>

					<button class="header_search_bar">
						<i class="material-icons dp48">search</i>
					</button>

					<!-- <a href="{{route('business.profile.create')}}" itemprop="Business Profile" type="button" class="btn_profile btn_green">
					    <span class="material-icons"> add </span> Business Profile
					</a> -->

				</div>
			</div>
		</header>
		<!-- Desktop header end -->
		
		<!-- Mobile header -->
		<header class="mobile_header" itemscope>
			<div class="col m2 logo center-align" itemscope>
				<a href="{{route('home')}}" itemprop="Logo"><img itemprop="img" src="{{asset('images/frontendimages/new_layout_images/logo.png')}}" alt="logo" /></a>
			</div>
			<div class="row" itemscope>
				<div class="col s2 mainNav_mobile_wrap" itemscope>
					<a onclick="openNav()" itemprop="Menu Trigger" href="javascript:void(0);" class="btn-sidenav-left"><i class="material-icons">menu</i></a>
					<div id="mySidenav" class="mySidenav" itemscope>
						<a href="javascript:void(0)" class="closebtn" itemprop="Close Nav" onclick="closeNav()"><i class="material-icons right">keyboard_backspace</i></a>
						
						<ul itemscope itemtype="https://schema.org/ListItem">
							<li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="Products" href="javascript:void(0);" data-target="studio-products-mobile">Studio <span class="subnev_arrow"><i class="material-icons right">keyboard_arrow_down</i></span></a>
								
								<!-- Dropdown Structure -->
								<ul id="studio-products-mobile" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a itemprop="Designs" href="{{route('product.type.mapping',['studio', 'design'])}}" class="{{ Route::is('products') ? 'active' : ''}}">Designs</a></li>
									<li itemprop="itemListElement"><a itemprop="Production Sample" href="{{route('product.type.mapping',['studio', 'product_sample'])}}" class="{{ Route::is('readystockproducts') ? 'active' : ''}}">Production Sample</a></li>
									<li itemprop="itemListElement"><a itemprop="Ready Stock" href="{{route('product.type.mapping',['studio', 'ready_stock'])}}" >Ready Stock</a></li>
								</ul>
							</li>
							<li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="Products" href="javascript:void(0);" data-target="more-system-products-mobile">Raw Materials <span class="subnev_arrow"><i class="material-icons right">keyboard_arrow_down</i></span></a>
								<!-- Dropdown Structure -->
								<ul id="more-system-products-mobile" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a itemprop="Textile" href="{{route('product.type.mapping',['raw_materials', 'textile'])}}" class="{{ Route::is('products') ? 'active' : ''}}">Textile</a></li>
									<li itemprop="itemListElement"><a itemprop="Yarn" href="{{route('product.type.mapping',['raw_materials', 'yarn'])}}" class="{{ Route::is('readystockproducts') ? 'active' : ''}}">Yarn</a></li>
									<li itemprop="itemListElement"><a itemprop="Trims and Accessories" href="{{route('product.type.mapping',['raw_materials', 'trims_and_accessories'])}}" class="{{ Route::is('buydesignsproducts') ? 'active' : ''}}">Trims and Accessories</a></li>
								</ul>
							</li>
							<li itemprop="itemListElement"><a itemprop="Suppliers" class="{{ Route::is('suppliers') ? 'active' : ''}}" href="{{route('suppliers')}}">Suppliers</a></li>
							<li itemprop="itemListElement"><a itemprop="Tools" class="{{ Route::is('front.tools') ? 'active' : ''}}" href="{{route('front.tools')}}">Tools</a></li>
							<li itemprop="itemListElement"><a itemprop="RFQ" class="{{ Route::is('rfq.index') ? 'active' : ''}}" href="{{route('rfq.index')}}">RFQ</a></li>
							<li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="More" href="javascript:void(0);" data-target="more-system-links-mobile">More <span class="subnev_arrow"><i class="material-icons right">keyboard_arrow_down</i></span></a>
								<!-- Dropdown Structure -->
								<ul id="more-system-links-mobile" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a href="{{route('industry.blogs')}}" itemprop="Blog" class="{{ Route::is('industry.blogs') ? 'active' : ''}}">Blogs</a></li>
									<li itemprop="itemListElement"><a href="http://insight.merchantbay.com/" itemprop="Insights">Insights</a></li>
									<li itemprop="itemListElement" style="display: none;"><a href="javascript:void(0);" itemprop="Helps">Helps</a></li>
									<li itemprop="itemListElement" style="display: none;"><a href="javascript:void(0);" itemprop="FAQs">FAQs</a></li>
								</ul>
							</li>
						</ul>
						
						<!-- <ul itemscope itemtype="https://schema.org/ListItem">
							<li itemprop="itemListElement">
								<a class="dropdown-trigger" itemprop="Products" href="javascript:void(0);" data-target="more-system-products-mobile">Products <span class="subnev_arrow"><span class="material-icons right">keyboard_arrow_down</span></span></a>
								
								<ul id="more-system-products-mobile" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a itemprop="All Products" href="{{route('products')}}">All</a></li>
									<li itemprop="itemListElement"><a itemprop="Ready to Ship" href="{{route('readystockproducts')}}">Ready to Ship</a></li>
									<li itemprop="itemListElement"><a itemprop="Designs" href="{{route('buydesignsproducts')}}">Designs</a></li>
									<li itemprop="itemListElement"><a itemprop="Low MOQ" href="{{route('low.moq')}}">Low MOQ</a></li>
									<li itemprop="itemListElement"><a itemprop="Shortest Lead Time" href="{{route('shortest.lead.time')}}">Shortest Lead Time</a></li>
									<li itemprop="itemListElement"><a itemprop="Customizable" href="{{route('customizable')}}">Customizable</a></li>
								</ul>
							</li>
							<li itemprop="itemListElement"><a itemprop="Suppliers" href="{{route('suppliers')}}">Suppliers</a></li>
							<li itemprop="itemListElement"><a itemprop="Tools" href="{{route('front.tools')}}">Tools</a></li>
							<li itemprop="itemListElement"><a itemprop="RFQ" href="{{route('rfq.index')}}">RFQ</a></li>
							<li itemprop="itemListElement">
								<a class="dropdown-trigger subnev_open" itemprop="More" href="javascript:void(0);" data-target="more-system-links-mobile">More <span class="subnev_arrow"><span class="material-icons right">keyboard_arrow_down</span></span></a>
								
								<ul id="more-system-links-mobile" class="dropdown-content subNav" itemscope itemtype="https://schema.org/ListItem">
									<li itemprop="itemListElement"><a itemprop="Blogs" href="{{route('industry.blogs')}}">Blogs</a></li>
									<li itemprop="itemListElement"><a itemprop="Insights" href="http://insight.merchantbay.com/">Insights</a></li>
									<li style="display: none;" itemprop="itemListElement"><a itemprop="Helps" href="javascript:void(0);">Helps</a></li>
									<li style="display: none;" itemprop="itemListElement"><a itemprop="FAQs" href="javascript:void(0);">FAQs</a></li>
								</ul>
							</li>
						</ul> -->
					</div>
				</div>

				<div class="col s10 right-align mobile_top_right" itemscope>

					<div class="user-block user-block-mobile mobile_top_icon_box" itemscope>
						@if(env('APP_ENV') == 'production')
							@if(Auth::guard('web')->check() && Cookie::has('sso_token'))
								<a href="javascript:void(0);" class="dropdown-trigger waves-effect waves-block waves-light" data-target="profile-dropdown-mobile" itemscope>
									<span class="avatar-status avatar-online" itemprop="Merchantbay Profile Image">
										@if(auth()->user()->image)
										<img src="{{ asset('storage/'.auth()->user()->image) }}" itemprop="img" alt="avatar">
										@else
										<img src="{{asset('images/frontendimages/no-image.png')}}" itemprop="img" alt="avatar">
										@endif
									</span>
								</a>
								<ul id="profile-dropdown-mobile" class="dropdown-content profile_dropdown_mobile card" itemscope itemtype="https://schema.org/ListItem">
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" href="{{ route('users.profile') }}" itemprop="Profile"><i class="material-icons">person_outline</i> Profile</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" href="{{route('business.profile')}}" itemprop="My Business"><i class="material-icons">store</i> My Business</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" href="{{route('wishlist.index')}}" itemprop="My favorite"><i class="material-icons">favorite</i> My favorite</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" href="{{env('SSO_URL').'/profile'}}" itemprop="Settings"><i class="material-icons">settings</i> Settings</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" href="{{ route('logout') }}" itemprop="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
									</li>
								</ul>
								<form id="logout-form" itemscope action="{{ route('users.logout') }}" method="POST">
									@csrf
								</form>
							@else
								<a href="#login-register-modal" itemprop="Login" class="btn_login_mobile modal-trigger">
									<span class="material-icons">login</span>
								</a>
							@endif

							@else
								@if(Auth::guard('web')->check())
								<a href="javascript:void(0);" itemscope class="dropdown-trigger waves-effect waves-block waves-light" data-target="profile-dropdown-mobile">
									<span class="avatar-status avatar-online" itemprop="Merchantbay Profile Image">
										@if(auth()->user()->image)
										<img src="{{ asset('storage/'.auth()->user()->image) }}" itemprop="img" alt="avatar">
										@else
										<img src="{{asset('images/frontendimages/no-image.png')}}" itemprop="img" alt="avatar">
										@endif
									</span>
								</a>
								<ul id="profile-dropdown-mobile" class="dropdown-content card" itemscope itemtype="https://schema.org/ListItem">
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Profile" href="{{ route('users.profile') }}"><i class="material-icons">person_outline</i> Profile</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="My Business" href="{{route('business.profile')}}"><i class="material-icons">store</i> My Business</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="My Favorite" href="{{route('wishlist.index')}}"><i class="material-icons">favorite</i> My favorite</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Settings" href="{{env('SSO_URL').'/profile'}}"><i class="material-icons">settings</i> Settings</a>
									</li>
									<li tabindex="0" itemprop="itemListElement">
										<a class="grey-text text-darken-1" itemprop="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
									</li>
								</ul>
								<form id="logout-form" itemscope action="{{ route('users.logout') }}" method="POST">
									@csrf
								</form>
								@else
									<a href="#login-register-modal" itemprop="Login" class="btn_login_mobile modal-trigger">
										<span class="material-icons">login</span>
									</a>
							@endif

						@endif
					</div>

					<!-- @if(auth()->user())
						<div class="notifications_icon_wrap mobile_top_icon_box">
							<a href="javascript:void(0);">
								<i class="material-icons">notifications</i>
								<span id="" class="noticication_counter">{{count($userNotifications)}}</span>
							</a>
						</div>
						<ul>
							@foreach($userNotifications as $notification)
							<li class="">
								@if($notification->type == 'App\Notifications\NewOrderHasPlacedNotification')
								<a href="{{route('vendor.order.show.notification',['businessProfile'=>$notification->data['order']['business_profile_id'],'order'=>$notification->data['order']['order_number'],'notification'=>$notification->id])}}">
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\OrderQueryNotification' )
								<a href="{{ url($notification->data['url']) }}" >
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\NewOrderModificationRequestNotification' )
								<a href="{{ $notification->data['url'] }}" >
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\QueryCommuncationNotification' )
								<a href="{{ $notification->data['url'] }}" >
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type == 'App\Notifications\PaymentSuccessNotification')
								<a href="{{ $notification->data['url'] }}" >
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type =='App\Notifications\NewRfqNotification')
								<a href="{{ $notification->data['url'] }}" >
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@elseif ($notification->type =='App\Notifications\RfqBidNotification')
								<a href="{{ $notification->data['url'] }}" >
									<i class="fas fa-envelope mr-2"></i>
									<div class="admin-notification-content">
									<div class="admin-notification-title">{{$notification->data['title']}}</div>
									<div class="text-muted text-sm">{{$notification->created_at}}</div>
									</div>
								</a>
								@endif
							</li>
							@endforeach

							<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
							</div>

						</ul>
						<div class="header_message_box mobile_top_icon_box">
							<a href="{{route('message.center')}}">
								<i class="material-icons">message</i>
								<span class="sms_counter ">0</span>
							</a>
						</div>
					@endif -->



					<div class="mobile_notification_wrap" itemscope>
						@if(auth()->user())
							<div class="notifications_icon_wrap mobile_top_icon_box mobile_notifications_icon_wrap" itemscope>
								<a href="javascript:void(0);" class="dropdown-trigger" data-target="countdown-dropdown-mobile" itemprop="User Notification">
									<i class="material-icons">notifications</i>
									<!-- <span id="" class="noticication_counter">{{count($userNotifications)}}</span> -->
									@if(count($userNotifications) > 0)
									<span id="" class="noticication_counter">{{ count($userNotifications) }}</span>
									@endif
								</a>
							</div>

							<ul id="countdown-dropdown-mobile" class="card dropdown-content" itemscope itemtype="https://schema.org/ListItem">
								@if(count($userNotifications)>0)
								<li itemprop="itemListElement" class="">
									@foreach($userNotifications as $notification)
										@if($notification->type == 'App\Notifications\NewOrderHasPlacedNotification')
										<a itemprop="New Order Place Notification" href="{{route('vendor.order.show.notification',['businessProfile'=>$notification->data['order']['business_profile_id'],'order'=>$notification->data['order']['order_number'],'notification'=>$notification->id])}}" class="dropdown-item">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif($notification->type == 'App\Notifications\NewOrderHasApprovedNotification')
										<a itemprop="New Order Approve Notification" href="{{ url($notification->data['url']) }}" class="dropdown-item">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type == 'App\Notifications\OrderQueryNotification' )
										<a href="{{ url($notification->data['url']) }}" itemprop="Order Query Notification" class="dropdown-item">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type == 'App\Notifications\OrderQueryFromAdminNotification' )
										<a href="{{ url($notification->data['url']) }}" itemprop="Order Query From Admin Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>

										@elseif ($notification->type == 'App\Notifications\NewOrderModificationRequestNotification' )
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="New Order Modification Request Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type == 'App\Notifications\QueryCommuncationNotification' )
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="Query Communication Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type == 'App\Notifications\QueryWithModificationToUserNotification')
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="Query With Modification To User Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type == 'App\Notifications\PaymentSuccessNotification')
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="Payment Success Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
												<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
												<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type =='App\Notifications\NewRfqNotification')
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="New RFQ Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
											<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
											<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@elseif ($notification->type =='App\Notifications\RfqBidNotification')
										<a href="{{ url($notification->data['url']) }}" class="dropdown-item" itemprop="RFQ Bid Notification">
											<i class="fas fa-envelope mr-2"></i>
											<div class="admin-notification-content" itemscope>
											<div class="admin-notification-title" itemprop="{{$notification->data['title']}}">{{$notification->data['title']}}</div>
											<div class="text-muted text-sm" itemprop="Create Date" datetime="{{$notification->created_at}}">{{$notification->created_at}}</div>
											</div>
										</a>
										@endif
									@endforeach
								</li>
								@else
								<li itemprop="itemListElement" class="no-notifications">
									No notifications
								</li>
								@endif
							</ul>

							<div class="header_message_box mobile_top_icon_box" itemscope>
								<a href="{{route('message.center')}}" itemprop="Message Center">
									<i class="material-icons">message</i>
									@if(count($messageCenterNotifications) > 0)
									<span class="sms_counter">{{ count($messageCenterNotifications) }}</span>
									@endif
								</a>
							</div>

						@endif
					</div>

					<div class="mobile_top_icon_box" itemscope>
						<a href="javascript:void(0)" itemprop="Join MB Pool" type="button" class="btn_joinpool_mobile">
							<span class="material-icons"> add </span>
						</a>
						<!-- <a href="{{route('business.profile.create')}}" itemprop="My Profile" type="button" class="btn_profile_mobile">
							<span class="material-icons"> add </span>
						</a> -->
					</div>

					<button class="header_search_bar">
						<i class="material-icons dp48">search</i>
					</button>

				</div>
			</div>
		</header>
		<!-- Mobile header end -->

		<div class="banner_search" itemscope style="display: none;">
			@php
				$searchType= request()->get('search_type');
			@endphp
			<div class="module-search">
				<select id="searchOption" class="select2 browser-default select-search-type">
					<option value="all" name="search_key" {{ $searchType=="all" ? 'selected' : '' }}>All</option>
					<option value="product" name="search_key" {{ $searchType=="product" ? 'selected' : '' }}>Products</option>
					<option value="vendor"  name="search_key" {{ $searchType=="vendor" ? 'selected' : '' }}>Manufacturers</option>
				</select>
				<form name="system_search" action="{{route('onsubmit.search')}}" id="system_search" method="get">
					@if(Route::is('onsubmit.search'))
					<input type="text" placeholder="Example: Baby Sweaters, T-Shirts, Viscose, Radiant Sweaters etc." value="{{$searchInputValue}}" class="search_input"  name="search_input"/>
					@else
					<input type="text" placeholder="Example: Baby Sweaters, T-Shirts, Viscose, Radiant Sweaters etc." value="" class="search_input"  name="search_input"/>
					@endif
					<input type="hidden" name="search_type" class="search_type" value="" />
					<button class="btn waves-effect waves-light green darken-1 search-btn" type="submit" ><i class="material-icons dp48">search</i></button>
				</form>
				<div id="search-results-wrapper" style="display: none;">
					<div id="loadingSearchProgressContainer">
						<div id="loadingSearchProgressElement">
							<img src="{{asset('images/frontendimages/new_layout_images/loading-gray.gif')}}" width="128" height="15" alt="Loading">
							<div class="loading-message" style="display: none;">Loading...</div>
						</div>
					</div>
					<a href="javascript:void(0)" class="close-search-modal-trigger"><i class="material-icons dp48">cancel</i></a>                    
					<div id="search-results" style="display: none;"></div>
				</div>
			</div>
		</div>



	</div>

	

	
</section>



<!-- Header section end -->




<!-- Profile section start -->
<section class="profile_bannerwrap">
	<div class="banner_overlay">
		<h1>{{$business_profile->business_name}}</h1>
		<h2>In Speed We believe</h2>
		<div class="erified">
		<span class="leftText">erified</span> <span class="rightText">by Merchant Bay</span>
		</div>
		<div class="edit_profile_option">
			<a href="javascript:void(0);" class="edit_wholesaler_profile_trigger"><i class="material-icons">border_color</i></a>
		</div>		
	</div>
</section>
<!-- Profile section end -->

<!-- Main Container start -->
<section class="mainContainer profile_container">
	<div class="container">
		<div class="row">
			<div class="col s12 m5 l3 profile_leftCol leftCol_wrap">
				<div class="left_top">
					<div class="profile_pic center-align">
						@if(auth()->user()->image)
						<img src="{{ asset('storage/'.auth()->user()->image) }}" alt="avatar">
						@else
						<img src="{{asset('images/frontendimages/no-image.png')}}" alt="avatar">
						@endif
					</div>
					<div class="office_address center-align ">
						<h3>{{$business_profile->business_name}}</h3>
						<h4><span class="material-icons">pin_drop</span> {{$business_profile->location}} <img src="{{asset('images/frontendimages/new_layout_images/bd_flg.png')}}" style="display: none;" alt="" /> </h4>
						<p>@php echo ($business_profile->business_type==1)?'Manufacturer':'Wholesaler'; @endphp, {{$business_profile->industry_type}}</p>
					</div>
					<div class="center-align" style="display: none;">
						<a href="#" class="btn_green btn_supplier">Contact Supplier</a>
					</div>
					<div class="addressBox">
						<span>Head Office </span><br/>
						<div id="head-office">
							@if($business_profile->companyOverview->address)
								<p>{{$business_profile->companyOverview->address}}</p>
							@else
							<div class="card-alert card cyan lighten-5">
								<div class="card-content cyan-text">
									INFO : No data found.
								</div>
							</div>
							@endif
						</div>
					</div>
					<div class="addressBox">
						<span>Factory Address</span> <br/>
						<div id="factory-address">
							@if($business_profile->companyOverview->factory_address)
								<p>{{$business_profile->companyOverview->factory_address}}</p>
							@else
							<div class="card-alert card cyan lighten-5">
								<div class="card-content cyan-text">
									INFO : No data found.
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="left_bottom">
					<h3 class="center-align" >Main Products</h3>
					<div id="main-products">
						@foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
							@if($company_overview->name=="main_products")
								@if($company_overview->value)
									<p>{{$company_overview->value}}</p>
								@else
								<div class="card-alert card cyan lighten-5 no-info-message">
									<div class="card-content cyan-text">
										INFO : No data found.
									</div>
								</div>
								@endif
							@endif
						@endforeach
					</div>
				</div>
			</div>

			<!-- Container section start -->
			<div class="col s12 m7 l9 profile_contentCol wholesaler_profile_info_details">
				<div class="profile_tabNav_wrap"> <!-- div close in profile_footer file -->
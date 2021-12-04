<!-- Profile section start -->
<section class="profile_bannerwrap">
	<div class="banner_overlay">
		<h1>Sayem Group</h1>
		<h2>In Speed We believe</h2>
		<div class="erified">
		<span class="leftText">erified</span> <span class="rightText">by Merchant Bay</span>
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
					<div class="profile_pic center-align"><img src="{{asset('images/frontendimages/new_layout_images/ic-logo.png')}}" alt="Ic logo" /> </div>
					<div class="office_address center-align ">
						<h3>{{$business_profile->business_name}}</h3>
						<h4><span class="material-icons">pin_drop</span> {{$business_profile->location}} <img src="{{asset('images/frontendimages/new_layout_images/bd_flg.png')}}" alt="" /> </h4>
						<p>@php echo ($business_profile->business_type==1)?'Manufacturer':'Wholesaler'; @endphp, {{$business_profile->industry_type}}</p>
					</div>
					<div class="center-align">
						<a href="#" class="btn_green btn_supplier">Contact Supplier</a>
					</div>
					<div class="addressBox">
						<span>Head Office </span><br/>
						<p>House#27, Road# 16, Sector#4, <br/> 
							Uttara, Dhaka-1230. <br/>
							Bangladesh.
						</p>
					</div>
					<div class="addressBox">
						<span>Factory Address</span> <br/>
						<p>Kamarjhuri, National University, 
							Gazipur, Bangladesh.
						</p>
					</div>
				</div>
				<div class="left_bottom">
					<h3 class="center-align" >Main Products</h3>
					<p>Men & Women's Sweater, Men & 
						Women's Dress, Plus Size Women's 
						Clothing, Men & Women's Coats, 
						Men & Women's Hoodies
						& Sweatshirts, Downjackets.
					</p>
				</div>
			</div>

			<!-- Container section start -->
			<div class="col s12 m7 l9 profile_contentCol">
				<div class="profile_tabNav_wrap"> <!-- div close in profile_footer file -->
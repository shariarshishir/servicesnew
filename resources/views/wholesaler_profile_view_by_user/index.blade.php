@extends('layouts.app_containerless')

@section('content')
@include('sweet::alert')

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
						<h3>Sayem Group</h3>
						<h4><span class="material-icons">pin_drop</span> Dhaka, BD <img src="{{asset('images/frontendimages/new_layout_images/bd_flg.png')}}" alt="" /> </h4>
						<p>Manufacturer, Sweater</p>
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
				<div class="profile_tabNav_wrap">
					<div class="profile_tab_menu">
						<ul class="tabs">
							<li class="tab"><a href="#home">Home</a></li>
							<li class="tab"><a href="#profile">Profile</a></li>
							<li class="tab"><a href="#products">Products</a></li>
							<!--li class="tab col m2"><a href="#womenproducts">Women</a></li-->
							<li class="tab"><a href="#factorytour">Factory Tour</a></li>
							<li class="tab"><a href="#termsservice">Terms of Service</a></li>
						</ul>
					</div>
					<div id="home" class="tabcontent">
						<h3>About the Company</h3>
						<!-- company_stuff -->
						<div class="contentBox">
							<p>Sayem Fashions LTD. & Radiant Sweater Ind. Ltd are two units of manufacturing within Sayem Group, aspiring for complete customer satisfaction owing
								to the high quality Sweater at competitive prices with an on-schedule delivery and perfection in service. It firmly believes that the satisfaction of the valued
								customers is the focal point of its business. In no time, the brand has become a name to reckon within the manufactures of Pullovers, Cardigans, Sweaters,
								Jumpers, Vests, Scarves and Woolen Cap etc, for men, women and children. Manufacturing around 280,000 to 300,000 pcs of both Basic and Fashionable,
								Fancy sweaters of valued customers from 3gg – 12gg.
							</p>
							<p>The factory premises are run by experienced workers since year 2000. The company proudly stands with the lowest employee turnover rate and high
								employee satisfaction. All resources and facilities are available within the premises around the clock.
							</p>
							<p>Specials team works on Fire Safety measures and everyone regularly practicing fire drills to avoid panic attack during any accidents. All fire safety measures
								are taken and necessary training and fire fighters are managed on the floors.
							</p>
						</div>
						<!-- contentBox -->
						
						
					</div>
					<!-- Home tabcontent end -->
					<div id="profile" class="tabcontent">
						<div class="overview_table_wrap">
								<div class="row top_titleWrap">
									<div class="col s6 m6">
										<h3>Company Overview</h3>
									</div>
								
								</div>
								
								<div class="overview_table box_shadow">
									<table>
										<tbody>
											@if(count(json_decode($business_profile->companyOverview->data))>0)
												@foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
												<tr>
													<td>{{str_replace('_', ' ', ucfirst($company_overview->name))}}</td>
													<td class="{{$company_overview->name}}_value">{{$company_overview->value}}</td>
													@if($company_overview->status==1)
													<td><i class="material-icons {{$company_overview->name}}_status" style="color:green">check_circle</i></td>
													@else
													<td><i class="material-icons {{$company_overview->name}}_status"style="color:gray">check_circle</i></td>
													@endif
												</tr>
												@endforeach
											@else
												<tr>
													<td colspan="3">
														<div class="card-alert card cyan lighten-5">
															<div class="card-content cyan-text">
																<p>INFO : No data found.</p>
															</div>
														</div>													
													</td>
												</tr>
											@endif	
										</tbody>
									</table>
								</div>
							</div>
							<div class="membership_wrap">
								<div class="row top_titleWrap upload_delete_wrap">
									<div class="col s6 m6">
										<h3>Association memberships</h3>
									</div>
									
								</div>
								<div class="row membership_textBox association-membership-block">
									@if(count($business_profile->associationMemberships))>0)
										@foreach($business_profile->associationMemberships as $associationMembership)
										<div class="col s12 m6 l5 center-align association-membership-img">
											<a href="javascript:void(0)" style="display: none;"data-id="{{$associationMembership->id}}" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>
											<div class="imgbox"><img  src="{{ asset('storage/'.$associationMembership->image) }}" alt=""></div>
											<p>{{$associationMembership->title}}</p>
										</div>
										@endforeach
									@else
										<tr>
											<td colspan="3">
												<div class="card-alert card cyan lighten-5">
													<div class="card-content cyan-text">
														<p>INFO : No data found.</p>
													</div>
												</div>													
											</td>
										</tr>
									@endif	
								</div>
							</div>
							<div class="pr_highlights_wrap">
								<div class="row top_titleWrap upload_delete_wrap">
									<div class="col s6 m6">
										<h3>PR Highlights</h3>
									</div>
									
								</div>
								<div class="row press-highlight-block">
									@if(count($business_profile->pressHighlights))>0)
										@foreach($business_profile->pressHighlights as $pressHighlight)
											<div class="col s6 m4 l2 paper_img press-highlight-img">
												<a href="javascript:void(0)" style="display: none;"data-id="{{$pressHighlight->id}}" class="remove-press-highlight"><i class="material-icons dp48">remove_circle_outline</i></a>
												<div class="press_img">
													<img src="{{ asset('storage/'.$pressHighlight->image) }}" alt="" />
												</div>
											</div>
										@endforeach
									@else
										<tr>
											<td colspan="3">
												<div class="card-alert card cyan lighten-5">
													<div class="card-content cyan-text">
														<p>INFO : No data found.</p>
													</div>
												</div>													
											</td>
										</tr>
									@endif	
									
								</div>
							</div>
						</div>
					</div>
					<div id="products" class="tabcontent">

						<div id="manufacture_edit_errors"></div>
						<div class="manufacture-product-table-data">
							@include('wholesaler_profile_view_by_user._product_list')
						</div>

					</div>
					<div id="factorytour" class="tabcontent">
							<div class="profile_factory_tourWrap">
								<div class="row top_titleWrap">
									<div class="col s6 m6">
										<h3>Virtual Tour</h3>
									</div>
									<div class="col s6 m6 right-align">
										<a href="javascript:void(0);">Watch on YouTube</a>
									</div>
								</div>
								<div class="factory_video_box">
									<img src="{{asset('images/frontendimages/new_layout_images/video_img.png')}}" />
								</div>
								<div class="factory_imgbox_wrap video_gallery_box">
									<div class="row top_titleWrap">
										<div class="col s6 m6 gallery_navbar">
											<ul>
												<li class="active"><a href="javascript:void(0);">Factory Images</a></li>
												<li><a href="javascript:void(0);">360 Degree Images</a></li>
											</ul>
										</div>
										<div class="col s6 m6 product_view right-align"><a href="javascript:void(0);"> View all </a></div>
									</div>
									<div class="row factory_image_gallery">
										<div class="col s6 m4 l4">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/factory_1.jpg')}}" alt=""></div>
										</div>
										<div class="col s6 m4 l4">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/factory_2.jpg')}}" alt=""></div>
										</div>
										<div class="col s6 m4 l4">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/factory_3.jpg')}}" alt=""></div>
										</div>
										<div class="col s6 m4 l4">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/factory_4.jpg')}}" alt=""></div>
										</div>
										<div class="col s6 m4 l4">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/factory_5.jpg')}}" alt=""></div>
										</div>
										<div class="col s6 m4 l4">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/factory_1.jpg')}}" alt=""></div>
										</div>
									</div>
								</div>
								<div class="factory_imgbox_wrap video_gallery_box">
									<div class="row top_titleWrap">
										<div class="col s6 m6 gallery_navbar">
											<ul>
												<li><a href="javascript:void(0);">Factory Images</a></li>
												<li class="active"><a href="javascript:void(0);">360 Degree Images</a></li>
											</ul>
										</div>
										<div class="col s6 m6 product_view right-align"><a href="javascript:void(0);"> View all </a></div>
									</div>
									<div class="row 360_degree_video_gallery">
										<div class="col s12 m6 l6">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/360_degree_img1.png')}}" alt=""></div>
										</div>
										<div class="col s12 m6 l6">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/360_degree_img2.png')}}" alt=""></div>
										</div>
										<div class="col s12 m6 l6">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/360_degree_img3.png')}}" alt=""></div>
										</div>
										<div class="col s12 m6 l6">
											<div class="imgBox"><img src="{{asset('images/frontendimages/new_layout_images/360_degree_img4.png')}}" alt=""></div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div id="termsservice" class="tabcontent">
						<h3>Terms of Service</h3>
						<p>Who we are and what we do.</p>
					</div>
				</div>
			</div>
			<!-- Container section end -->
		</div>
	</div>
</section>

@endsection

@include('wholesaler_profile_view_by_user._scripts')

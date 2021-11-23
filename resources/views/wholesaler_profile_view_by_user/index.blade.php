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
						<div class="company_stuff center-align row">
							<div class="col s6 m3 l2">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/factory.png')}}" alt="" />
								</div>
								<div class="title">Floor Space</div>
								<div class="quantity">2,50,000 sqr ft</div>
							</div>
							<div class="col s6 m3 l2">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/sewing-machine.png')}}" alt="" />
								</div>
								<div class="title">No. of Machines</div>
								<div class="quantity">1470 pcs</div>
							</div>
							<div class="col s6 m3 l3">
								<img src="{{asset('images/frontendimages/new_layout_images/production.png')}}" alt="" />
								<div class="title">Production Capacity</div>
								<div class="quantity">3,50,000 pcs</div>
							</div>
							<div class="col s6 m3 l2">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/workers.png')}}" alt="" />
								</div>
								<div class="title">No. of workers</div>
								<div class="quantity">1300</div>
							</div>
							<div class="col s6 m3 l3">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/human.png')}}" alt="" />
								</div>
								<div class="title">No. of female workers</div>
								<div class="quantity">1000</div>
							</div>
						</div>
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
						<div class="certifications">
							<h3>Certifications</h3>
							<div class="row">
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/accord.png')}}" alt="" /></div>
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/sedex.png')}}" alt="" /></div>
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/iso.png')}}" alt="" /></div>
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/alliance.png')}}" alt="" /></div>
							</div>
						</div>
						<!-- certifications -->
						<div class="profile_product_wrap product_wrapper">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Main Products</h3>
								</div>
								<div class="col s6 m6 product_view right-align"><a href="javascript:void(0);"> View all </a></div>
							</div>
							<div class="product_boxwrap row">
								<div class="productBox col s6 m3 l3">
									<div class="imgBox">
										<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/sayem_01.jpg')}}" alt=""></a>
										<div class="favorite"><span class="material-icons">favorite</span></div>
									</div>
									<div class="priceBox row">
										<div class="col m5 s5 apperal">Apperal</div>
										<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
									</div>
									<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
									<div class="moq">MOQ  150 <span>pcs</span></div>
									<div class="leadTime">Lead time 10 <span>days</span></div>
								</div>
								<div class="productBox col s6 m3 l3">
									<div class="imgBox">
										<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/sayem_02.jpeg')}}" alt=""></a>
										<div class="favorite active_favorite"><span class="material-icons">favorite</span></div>
									</div>
									<div class="priceBox row">
										<div class="col m5 s5 apperal">Apperal</div>
										<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
									</div>
									<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
									<div class="moq">MOQ  150 <span>pcs</span></div>
									<div class="leadTime">Lead time 10 <span>days</span></div>
								</div>
								<div class="productBox col s6 m3 l3">
									<div class="imgBox">
										<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/sayem_03.jpeg')}}" alt=""></a>
										<div class="favorite"><span class="material-icons">favorite</span></div>
									</div>
									<div class="priceBox row">
										<div class="col m5 s5 apperal">Apperal</div>
										<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
									</div>
									<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
									<div class="moq">MOQ  150 <span>pcs</span></div>
									<div class="leadTime">Lead time 10 <span>days</span></div>
								</div>
								<div class="productBox col s6 m3 l3">
									<div class="imgBox">
										<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/sayem_04.jpeg')}}"></a>
										<div class="favorite"><span class="material-icons">favorite</span></div>
									</div>
									<div class="priceBox row">
										<div class="col m5 s5 apperal">Apperal</div>
										<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
									</div>
									<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
									<div class="moq">MOQ  150 <span>pcs</span></div>
									<div class="leadTime">Lead time 10 <span>days</span></div>
								</div>
							</div>
						</div>
						<!-- profile_product_wrap -->
						<div class="factory_imgbox_wrap">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Factory Images</h3>
								</div>
								<div class="col s6 m6 product_view right-align"><a href="javascript:void(0);"> View all </a></div>
							</div>
							<div class="row">
								<div class="col s6 m4">
									<div class="imgBox" ><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/factory_1.jpg')}}" alt="" /></a></div>
								</div>
								<div class="col s6 m4">
									<div class="imgBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/factory_2.jpg')}}" alt="" /></a></div>
								</div>
								<div class="col s6 m4">
									<div class="imgBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/factory_3.jpg')}}" alt="" /></a></div>
								</div>
								<div class="col s6 m4">
									<div class="imgBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/factory_4.jpg')}}" alt="" /></a></div>
								</div>
								<div class="col s6 m4">
									<div class="imgBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/factory_5.jpg')}}" alt="" /></a></div>
								</div>
								<div class="col s6 m4">
									<div class="imgBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/factory_1.jpg')}}" alt="" /></a></div>
								</div>
							</div>
						</div>
						<!-- factory_images -->
						<div class="main_buyers_wrap">
							<h3>Main Buyers</h3>
							<div class="buyers_logo_wrap row">
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/gemo.png')}}" alt="" /> </a></div>
									<h5>GEMO GMBH</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/newyork.png')}}" alt="" /></a> </div>
									<h5>Newyorker Corp.</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/marisa.png')}}" alt="" /></a> </div>
									<h5>Marisa Group</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dansk.png')}}" alt="" /></a> </div>
									<h5>Dansk Supermarked</h5>
								</div>
							</div>
							<div class="buyers_logo_wrap row">
								<div class="col s6 m4 l3 center-align">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/tally_weijl.png')}}"  alt="" /></a> </div>
									<h5>Tally Weijl Fashion</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/takko.png')}}" alt="" /></a> </div>
									<h5>Takko Fashion</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/us_polo_assn.png')}}" alt="" /></a> </div>
									<h5>US Polo Assosiation</h5>
								</div>
								<div class="col s6 m4 l3 center-align">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/suzy.png')}}" /></a> </div>
									<h5>Suzy Shier</h5>
								</div>
							</div>
						</div>
						<!-- main_buyers logo -->
						<div class="export_destination_wrap">
							<h3>Export Destinations</h3>
							<div class="row flag_wrap center-align">
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/germany.png')}}" alt="" /></a></div>
									<h5>DE: Germany</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/greece_gla.png')}}" alt="" /></a></div>
									<h5>EL: Grece</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/hungary.png')}}" alt="" /></a></div>
									<h5>HU: Hungary</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/ireland.png')}}" alt="" /></a></div>
									<h5>IE: Ireland</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/italy.png')}}" alt="" /></a></div>
									<h5>IT: Italy</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/latvia.png')}}" alt="" /></a></div>
									<h5>LV: Latvia</h5>
								</div>
							</div>
						</div>
						<!-- export_destination -->
						<div  class="owner_info_wrap">
							<div class="row">
								<div class="col s12 m8 l9 owner_info_box">
									<h3>Chairman's word</h3>
									<p>“From the beginning of the company to the very present, the consistent motto and objective is to work with
										sincerity and maintain growth effectively. Giving employment to people and serving the society has always
										been the core value and motive for expanding business. We take care of the production in our establishment
										standing in our own land at kamarjuri, National University, Joydevpur, Gazipur. We never believe in giving sub-
										contract hence, we can keep our commitment of quality and lead time. We also have always taken care of our
										employees and labor in terms of safety, benefits and hence invested in to stay compliant. This year we plan to
										bring more machinery in the RMG units and also looking forward to enter new industries to create employment
										and increase the contribution to the society."
									</p>
								</div>
								<div class="col s12 m4 l3">
									<div class="owner_img"><img src="{{asset('images/frontendimages/new_layout_images/chairman.jpg')}}" alt="" /></div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m8 l9">
									<h3>Director's word</h3>
									<p>"It all started out of passion and a vision in 1999 and since 2014 it became my core duty to leverage the business
										into further heights with only one motto, “ Efficient and Uncompromising Service to our Customers”. Completing
										my Masters in International business and a diploma in Fashion and Merchandising I stepped in the scenario of
										this business in 2014 and since then we have focused a lot in Research, Design and Development to serve synergistic
										services to our customers and also bring full efficiency to meet their demands. Successfully we have maintained
										our core value of on time shipment even under immense pressure, yet keeping our staff and workers highly
										motivated to love their work and workplace. Currently, we are working on the mission to make business of
										manufacturing come with even more to it, where we can deliver our customer updated design collection
										development, fast sampling and a faster lead time for gaining market competitive advantage."
									</p>
								</div>
								<div class="col s12 m4 l3">
									<div class="owner_img"><img src="{{asset('images/frontendimages/new_layout_images/director.jpg')}}" alt="" /></div>
								</div>
							</div>
						</div>
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
										@foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
										<tr>
											<td>{{str_replace('_', ' ', ucfirst($company_overview->name))}}</td>
											<td class="{{$company_overview->name}}_value">{{$company_overview->value}}</td>
											<td class="{{$company_overview->name}}_status">{{$company_overview->status}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="overview_table_wrap capacity_machineries">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Capacity and Machineries</h3>
								</div>
							</div>
							<div class="row capacity_table">
								<div class="col s12 m6">
									<h4>Production Capacity (Annual)</h4>
									<div class="overview_table box_shadow">
										<table>
											<thead>
												<tr>
													<th>Machine Type</th>
													<th>Annual Capacity</th>
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody class="production-capacity-table-body">
												@if(count($business_profile->productionCapacities)>0)
													@foreach($business_profile->productionCapacities as $productionCapacity)
														<tr>
															<td>{{$productionCapacity->machine_type}}</td>
															<td>{{$productionCapacity->annual_capacity}}</td>
															<td>{{$productionCapacity->status}}</td>
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
								<div class="col s12 m6">
									<h4>Categories Produced</h4>
									<div class="overview_table box_shadow">
										<table>
											<thead>
												<tr>
													<th>Type</th>
													<th>Percentage</th>
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody class="categories-produced-table-body">
												@if(count($business_profile->categoriesProduceds)>0)
													@foreach($business_profile->categoriesProduceds as $categoriesProduced)
													<tr>
														<td>{{$categoriesProduced->type}}</td>
														<td>{{$categoriesProduced->percentage}}</td>
														<td>{{$categoriesProduced->status}}</td>
													</tr>
													@endforeach
												@else
													<tr>
														<td>
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
							</div>
						</div>
						<div class="overview_table_wrap machinery_table">
							<h3>Machinery Details</h3>
							<div class="overview_table box_shadow">
								<table>
									<thead>
										<tr>
											<th>Machine Name</th>
											<th>Quantity</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody class="machinaries-details-table-body">
										@if(count($business_profile->machineriesDetails)>0)
											@foreach($business_profile->machineriesDetails as $machineriesDetail)
											<tr>
												<td>{{$machineriesDetail->machine_name}}</td>
												<td>{{$machineriesDetail->quantity}}</td>
												<td>{{$machineriesDetail->status}}</td>
											</tr>
											@endforeach
										@else
											<tr>
												<td>
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
						<div class="overview_table_wrap">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Production Flow and Manpower</h3>
								</div>
							</div>

							<div class="production-flow-and-manpower-table-wrapper box_shadow overview_table">
								<table class="production-flow-and-manpower-table" style="width:100%">
									<tbody class="production-flow-and-manpower-table-body">
										<!-- Html will comes from script -->

										@if(count($business_profile->productionFlowAndManpowers)>0)
											@foreach($business_profile->productionFlowAndManpowers as $productionFlowAndManpower)
											<tr>
												<th>{{$productionFlowAndManpower->production_type}}</th>
												<td>
													<table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
													@foreach(json_decode($productionFlowAndManpower->flow_and_manpower) as $flowAndManpower)
													<tr>
														<td>{{$flowAndManpower->name}}</td>
														<td>{{$flowAndManpower->value}}</td>
														<td>{{$flowAndManpower->status}}</td>
													</tr>
													@endforeach
													</table>
												</td>
											</tr>
											@endforeach
										@else
											<tr>
												<td>
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
						<div class="certifications">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>Certifications</h3>
								</div>
							</div>
							<div class="row">
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/accord.png')}}" alt=""></div>
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/sedex.png')}}" alt=""></div>
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/iso.png')}}" alt=""></div>
								<div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/alliance.png')}}" alt=""></div>
							</div>
						</div>
						<div class="main_buyers_wrap">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>Main Buyers</h3>
								</div>
							</div>
							<div class="buyers_logo_wrap row">
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/gemo.png')}}" alt="" /> </a></div>
									<h5>GEMO GMBH</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/newyork.png')}}" alt="" /></a> </div>
									<h5>Newyorker Corp.</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/marisa.png')}}" alt="" /></a> </div>
									<h5>Marisa Group</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dansk.png')}}" alt="" /></a> </div>
									<h5>Dansk Supermarked</h5>
								</div>
							</div>
							<div class="buyers_logo_wrap row">
								<div class="col s6 m4 l3 center-align">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/tally_weijl.png')}}" alt="" /></a> </div>
									<h5>Tally Weijl Fashion</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/takko.png')}}" alt="" /></a> </div>
									<h5>Takko Fashion</h5>
								</div>
								<div class="col s6 m4 l3">
									<div class="logoBox"><a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/us_polo_assn.png')}}" alt="" /></a> </div>
									<h5>US Polo Assosiation</h5>
								</div>
								<div class="col s6 m4 l3 center-align">
									<div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/suzy.png')}}" alt="" /></a> </div>
									<h5>Suzy Shier</h5>
								</div>
							</div>
						</div>
						<div class="export_destination_wrap">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>Export Destinations</h3>
								</div>
							</div>
							<div class="row flag_wrap center-align">
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/germany.png')}}" alt="" /></a></div>
									<h5>DE: Germany</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/greece_gla.png')}}" alt="" /></a></div>
									<h5>EL: Grece</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/hungary.png')}}" alt="" /></a></div>
									<h5>HU: Hungary</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/ireland.png')}}" alt="" /></a></div>
									<h5>IE: Ireland</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/italy.png')}}" alt="" /></a></div>
									<h5>IT: Italy</h5>
								</div>
								<div class="col s6 m4 l2 flagBox">
									<div class="flag_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/latvia.png')}}" alt="" /></a></div>
									<h5>LV: Latvia</h5>
								</div>
							</div>
						</div>
						<div class="overview_table_wrap overview_table_alignLeft">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Business Terms</h3>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody>
										<tr>
											<td>Average Lead Time</td>
											<td>12 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Order Terms (FOB, CM)</td>
											<td>44 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Accepted payment Methods (Cash, LC...)</td>
											<td>65 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
											</td>
										</tr>
										<tr>
											<td>Nearest Port</td>
											<td>164 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Incoterms</td>
											<td>20 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="overview_table_wrap overview_table_alignLeft">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Sampling and R&D</h3>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody>
										<tr>
											<td>Sampling facility space</td>
											<td>12 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Manpower</td>
											<td>44 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Sampling lead time (in weeks)</td>
											<td>65 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
											</td>
										</tr>
										<tr>
											<td>SMS capacity/Lead Time (in weeks</td>
											<td>164 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Daily sample capacity</td>
											<td>20 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Design Studio facility</td>
											<td>20 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>Design Studio manpower</td>
											<td>20 sets</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="overview_table_wrap blank_overview_table_">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Special customization ability</h3>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="worker_welfare_wrap">
							<div class="row worker_welfare_box">
								<h3>Worker welfare and CSR</h3>
								<div class="col s12 m6 l7">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Healthcare Facility</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group1" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group1" type="radio">
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">On sight Doctor</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group2" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group2" type="radio">
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6 ">On sight Day Care</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group3" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group3" type="radio">
										<span>No</span>
										</label>
									</div>
								</div>
								<div class="col s12 m6 l5">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Playground</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group4" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group4" type="radio">
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Maternity Leave</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group5" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group5" type="radio">
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Social work</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group6" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group6" type="radio">
										<span>No</span>
										</label>
									</div>
								</div>
							</div>
							<div class="row worker_welfare_box">
								<h3>Security and others</h3>
								<div class="col s12 m6 l7">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Fire Exit</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group7" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group7" type="radio">
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">On sight Fire Hydrant</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group8" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group8" type="radio">
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Onsight water source</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group9" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group9" type="radio">
										<span>No</span>
										</label>
									</div>
								</div>
								<div class="col s12 m6 l5">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Other protocols</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group10" type="radio" checked="">
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="group10" type="radio">
										<span>No</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="overview_table_wrap blank_overview_table_">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Sustainability commitments</h3>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div class="verified_img">
													<img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
												</div>
											</td>
										</tr>
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
							<div class="row membership_textBox">
								<div class="col s12 m6 l5 center-align">
									<div class="imgbox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/bgmea.png')}}" alt="" /></a></div>
									<p>Bangladesh Garment Manufacturers and Exporters Association (BGMEA)</p>
								</div>
								<div class="col s12 m6 l5 center-align">
									<div class="imgbox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/bkmes.png')}}" alt="" /></a></div>
									<p>Bangladesh Knitwear Manufacturers and Exporters Association (BKMEA)</p>
								</div>
							</div>
						</div>
						<div class="pr_highlights_wrap">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>PR Highlights</h3>
								</div>
							</div>
							<div class="row">
								<div class="col s6 m4 l2 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/fex.png')}}" alt="" /></a></div>
								<div class="col s6 m4 l2 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/alo.png')}}" alt="" /></a></div>
								<div class="col s6 m4 l3 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dtribune.png')}}" alt="" /></a></div>
								<div class="col s6 m4 l2 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/bs.png')}}" alt="" /></a></div>
								<div class="col s6 m4 l3 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dstar.png')}}" alt="" /></a></div>
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

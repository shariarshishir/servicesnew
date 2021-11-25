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
						@foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
							@if($company_overview->name=='floor_space')
							<div class="col s6 m3 l2">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/factory.png')}}" alt="" /> 
								</div>
								<div class="title">Floor Space</div>
								<div class="quantity {{$company_overview->name}}_value">{{$company_overview->value}}</div>
							</div>
							@endif
							@if($company_overview->name=='no_of_machines')
							<div class="col s6 m3 l2">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/sewing-machine.png')}}" alt="" /> 
								</div>
								<div class="title">No. of Machines</div>
								<div class="quantity {{$company_overview->name}}_value">{{$company_overview->value}}pcs</div>
							</div>
							@endif
							@if($company_overview->name=='production_capacity')
							<div class="col s6 m3 l3">
								<img src="{{asset('images/frontendimages/new_layout_images/production.png')}}" alt="" /> 
								<div class="title">Production Capacity</div>
								<div class="quantity {{$company_overview->name}}_value">{{$company_overview->value}}pcs</div>
							</div>
							@endif
							@if($company_overview->name=='number_of_worker')
							<div class="col s6 m3 l2">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/workers.png')}}" alt="" /> 
								</div>
								<div class="title">No. of workers</div>
								<div class="quantity {{$company_overview->name}}_value">{{$company_overview->value}}</div>
							</div>
							@endif
							@if($company_overview->name=='number_of_female_worker')
							<div class="col s6 m3 l3">
								<div class="company_stuff_img">
									<img src="{{asset('images/frontendimages/new_layout_images/human.png')}}" alt="" /> 
								</div>
								<div class="title">No. of female workers</div>
								<div class="quantity {{$company_overview->name}}_value">{{$company_overview->value}}</div>
							</div>
							@endif
						@endforeach
						</div>
						<!-- company_stuff -->
						<div  class="contentBox">
							<p id="about-company-information">
							{{$business_profile->companyOverview->about_company}}
							</p>
						</div>
						<!-- contentBox -->
						<div class="certifications">
							<h3>Certifications</h3>
							<div class="row certifications-block">
							@if(count($business_profile->certifications)>0)
								@foreach($business_profile->certifications as $certification)
								<div class="col m3 l3"><img  src="{{ asset('storage/'.$certification->image) }}" alt=""></div>
								@endforeach
							@else
								<div class="card-alert card cyan lighten-5">
									<div class="card-content cyan-text">
										<p>INFO : No data found.</p>
									</div>
								</div>
							@endif
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
							<div class="buyers_logo_wrap row main-buyers-block">
								@if(count($business_profile->mainBuyers)>0)
								@foreach($business_profile->mainBuyers as $mainBuyers)
									<div class="col s6 m4 l3">
										<div class="logoBox"><a href="javascript:void(0);"><img  src="{{ asset('storage/'.$mainBuyers->image) }}" alt=""> </a></div>
										<h5>{{$mainBuyers->title}}</h5>
									</div>
								@endforeach
								@else
									<div class="card-alert card cyan lighten-5">
										<div class="card-content cyan-text">
											<p>INFO : No data found.</p>
										</div>
									</div>
								@endif
							</div>
							
						</div>
						<!-- main_buyers logo -->
						<div class="export_destination_wrap">
							<h3>Export Destinations</h3>
							<div class="row flag_wrap center-align export-destination-block">
								@if(count($business_profile->exportDestinations)>0)
									@foreach($business_profile->exportDestinations as $exportDestination)
										<div class="col s6 m4 l2">
											<div class="flag_img export-destination-img">
												<img  src="{{ asset('storage/'.$exportDestination->image) }}" alt="">
											</div>
											<h5>{{$exportDestination->title}}</h5>
										</div>
									@endforeach
								@else
									<div class="card-alert card cyan lighten-5">
										<div class="card-content cyan-text">
											<p>INFO : No data found.</p>
										</div>
									</div>
								@endif
								
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
								<div class="col s6 m6 right-align editBox">
									<button data-target="company-overview-modal" type="button" class="btn_edit btn_green_White modal-trigger"><span class="material-icons">border_color</span></span> Edit</button>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody>
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
									</tbody>
								</table>
							</div>
						</div>
						<div class="overview_table_wrap capacity_machineries">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Capacity and Machineries</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="capacity-and-machineries-modal" class="btn_edit btn_green_White modal-trigger"><span class="material-icons">border_color</span></span> Edit</button>
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
															@if($productionCapacity->status==1)
															<td><i class="material-icons" style="color:green">check_circle</i></td>
															@else
															<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
														@if($categoriesProduced->status==1)
														<td><i class="material-icons" style="color:green">check_circle</i></td>
														@else
														<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
												@if($machineriesDetail->status==1)
												<td><i class="material-icons" style="color:green">check_circle</i></td>
												@else
												<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
						<div class="overview_table_wrap">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Production Flow and Manpower</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="production-flow-and-manpower-modal" class="btn_edit btn_green_White modal-trigger"><span class="material-icons">border_color</span></span> Edit</button>
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
														@if($flowAndManpower->status==1)
														<td><i class="material-icons" style="color:green">check_circle</i></td>
														@else
														<td><i class="material-icons "style="color:gray">check_circle</i></td>
														@endif
													</tr>
													@endforeach
													</table>
												</td>
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
						<div class="certifications">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>Certifications</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="certification-upload-form-modal" class="btn_upload btn_green_White modal-trigger" ><span class="material-icons">file_upload</span></span> Upload</button>
									<button type="button" class="btn_delete btn_green_White delete-certification-button" ><span><span class="material-icons">delete</span></span> Delete</button>
								</div>
							</div>
							<div class="row certifications-block">
								@if(count($business_profile->certifications)>0)
									@foreach($business_profile->certifications as $certification)
									<div class="col m3 l3">
										<div class="certificate_img">
											<a href="javascript:void(0)" style="display: none;" data-id="{{$certification->id}}" class="remove-certificate" ><i class="material-icons dp48">remove_circle_outline</i></a>
											@if(pathinfo($certification->image, PATHINFO_EXTENSION) == 'pdf')
											<span>{{$certification->title}}</span>
											<i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
											<br>
											<a href="{{ asset('storage/'.$certification->image) }}" data-id="{{$certification->id}}" class="btn" ><i class="fas fa-arrow-alt-circle-down"></i></a> 
											@else
											<img  src="{{ asset('storage/'.$certification->image) }}" alt="">
											@endif
										</div>
									</div>
									@endforeach
								@else
									<div class="card-alert card cyan lighten-5">
										<div class="card-content cyan-text">
											<p>INFO : No data found.</p>
										</div>
									</div>
								@endif
							</div>
						</div>
						<div class="main_buyers_wrap">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>Main Buyers</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="main-buyers-upload-form-modal" class="btn_upload btn_green_White modal-trigger" ><span class="material-icons">file_upload</span></span> Upload</button>
									<button type="button" class="btn_delete btn_green_White  delete-main-buyer-button" ><span><span class="material-icons">delete</span></span> Delete</button>
								</div>
							</div>
							<div class="buyers_logo_wrap row main-buyers-block">
								@if(count($business_profile->mainBuyers)>0)
									@foreach($business_profile->mainBuyers as $mainBuyers)
									<div class="col s6 m4 l3">
										<div class="main_buyer_img">
											<a href="javascript:void(0)" style="display: none;"data-id="{{$mainBuyers->id}}" class="remove-main-buyer"><i class="material-icons dp48">remove_circle_outline</i></a>
											<img  src="{{ asset('storage/'.$mainBuyers->image) }}" alt="">
											<h5>{{$mainBuyers->title}}</h5>
										</div>
									</div>
									@endforeach
								@else
									<div class="card-alert card cyan lighten-5">
										<div class="card-content cyan-text">
											<p>INFO : No data found.</p>
										</div>
									</div>
								@endif
								
							</div>
						
						</div>
						<div class="export_destination_wrap">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>Export Destinations</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="export-destination-upload-form-modal" class="btn_upload btn_green_White modal-trigger" ><span class="material-icons">file_upload</span></span> Upload</button>
									<button type="button" class="btn_delete btn_green_White delete-export-destination-button" ><span><span class="material-icons">delete</span></span> Delete</button>
								</div>
							</div>
							<div class="row flag_wrap center-align">
								
								<div class="flagBox export-destination-block">
									@if(count($business_profile->exportDestinations)>0)
										@foreach($business_profile->exportDestinations as $exportDestination)
										<div class="col s6 m4 l2">
											<div class="flag_img export-destination-img">
												<a href="javascript:void(0)" style="display: none;"data-id="{{$exportDestination->id}}" class="remove-export-destination"><i class="material-icons dp48">remove_circle_outline</i></a>
												<img  src="{{ asset('storage/'.$exportDestination->image) }}" alt="">
											</div>
											<h5>{{$exportDestination->title}}</h5>
										</div>
										@endforeach
									@else
									<div class="card-alert card cyan lighten-5">
										<div class="card-content cyan-text">
											<p>INFO : No data found.</p>
										</div>
									</div>
									@endif
								</div>
								
							</div>

							<!-- <div class="row flag_wrap center-align">
								<div class="col s6 m4 l2 flagBox export-destination-block">
								@foreach($business_profile->exportDestinations as $exportDestination)
									<div class="flag_img export-destination-img">
										<a href="javascript:void(0)" style="display: none;"data-id="{{$exportDestination->id}}" class="remove-export-destination"><i class="material-icons dp48">remove_circle_outline</i></a>
										<img  src="{{ asset('storage/'.$exportDestination->image) }}" alt="">
									</div>
									<h5>{{$exportDestination->title}}</h5>
								@endforeach
								</div>
							</div> -->
							
						</div>
						<div class="overview_table_wrap overview_table_alignLeft">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Business Terms</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="business-term-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
								</div>
							</div>
							<div class="overview_table  box_shadow">
								<table>
									<tbody class="business-term-table-body">
									
										@if(count($business_profile->businessTerms)>0)
											@foreach($business_profile->businessTerms as $businessTerm)
											<tr>
												<td>{{$businessTerm->title}}</td>
												<td>{{$businessTerm->quantity}}</td>
												@if($businessTerm->status==1)
												<td><i class="material-icons" style="color:green">check_circle</i></td>
												@else
												<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
						<div class="overview_table_wrap overview_table_alignLeft">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Sampling and R&D</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="sampling-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody class="sampling-table-body">
											@if(count($business_profile->samplings))
												@foreach($business_profile->samplings as $sampling)
												<tr>
													<td>{{$sampling->title}}</td>
													<td>{{$sampling->quantity}}</td>
													@if($sampling->status==1)
													<td><i class="material-icons" style="color:green">check_circle</i></td>
													@else
													<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
						<div class="overview_table_wrap blank_overview_table_">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Special customization ability</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="special-customization-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
								<tbody class="special-customization-table-body">
											@if(count($business_profile->specialCustomizations))
												@foreach($business_profile->specialCustomizations as $specialCustomization)
												<tr>
													<td>{{$specialCustomization->title}}</td>
													@if($specialCustomization->status==1)
													<td><i class="material-icons" style="color:green">check_circle</i></td>
													@else
													<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
						<div class="worker_welfare_wrap">
							<div class="row worker_welfare_box">
								<div class="row top_titleWrap">
									<div class="col s6 m6">
										<h3>Worker welfare and CSR</h3>
									</div>
									<div class="col s6 m6 right-align editBox">
										<button type="button" data-target="worker-walfare-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
									</div>
								</div>

								@if($business_profile->walfare)
								<div class="col s12 m6 l7">
									@foreach(json_decode($business_profile->walfare->walfare_and_csr) as $walfareAndCsr)
								    @if($walfareAndCsr->name == 'healthcare_facility')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Healthcare Facility</span>
										<label class="radio_box col s2 m2 l2">
											<input class="with-gap health-facility-checked" name="healthcare_facility_disable"   disabled  type="radio" value="1" {{  ($walfareAndCsr->checked == "1" ? ' checked' : '') }}>
											<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
											<input class="with-gap health-facility-unchecked" name="healthcare_facility_disable"   disabled  value="0" type="radio" {{  ($walfareAndCsr->checked == "0" ? ' checked' : '') }}>
											<span>No</span>
										</label>
							
									</div>
									@endif
									@if($walfareAndCsr->name == 'doctor')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">On sight Doctor</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap doctor-checked" name="doctor_disable"   type="radio" value="1" disabled {{  ($walfareAndCsr->checked == "1" ? ' checked' : '') }}>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap doctor-unchecked" name="doctor_disable"   value="0" type="radio" disabled {{  ($walfareAndCsr->checked == "0" ? ' checked' : '') }}>
										<span>No</span>
										</label>
									</div>
									@endif
									@if($walfareAndCsr->name == 'day_care')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6 ">On sight Day Care</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap day-care-checked" name="day_care_disable" class="" type="radio" value="1" disabled {{  ($walfareAndCsr->checked == "1" ? ' checked' : '') }} >
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap day-care-unchecked" name="day_care_disable" class="" value="0" type="radio" disabled {{  ($walfareAndCsr->checked == "0" ? ' checked' : '') }}>
										<span>No</span>
										</label>
									</div>
									@endif
									@endforeach
								</div>

								<div class="col s12 m6 l5">
									@foreach(json_decode($business_profile->walfare->walfare_and_csr) as $walfareAndCsr)
								    @if($walfareAndCsr->name == 'playground')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Playground</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap playground-checked" name="playground_disable"    type="radio" value="1" disabled {{  ($walfareAndCsr->checked == "1" ? ' checked' : '') }}>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap playground-unchecked" name="playground_disable"    value="0" type="radio" disabled {{  ($walfareAndCsr->checked == "0" ? ' checked' : '') }}>
										<span>No</span>
										</label>
									</div>
									@endif
									@if($walfareAndCsr->name == 'maternity_leave')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Maternity Leave</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap maternity-leave-checked" name="maternity_leave_disable"  type="radio" disabled  value="1" {{  ($walfareAndCsr->checked == "1" ? ' checked' : '') }} > 
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap maternity-leave-unchecked" name="maternity_leave_disable" type="radio" disabled  value="0"  {{  ($walfareAndCsr->checked == "0" ? ' checked' : '') }}>
										<span>No</span>
										</label>
									</div>
									@endif
									@if($walfareAndCsr->name == 'social_work')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Social work</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap social-work-checked" name="social_work_disable"   type="radio" value="1" disabled {{  ($walfareAndCsr->checked == "1" ? ' checked' : '') }} >
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap social-work-unchecked" name="social_work_disable"  type="radio" value="0" disabled {{  ($walfareAndCsr->checked == "0" ? ' checked' : '') }} >
										<span>No</span>
										</label>
									</div>
									@endif
									@endforeach
								</div>
								@else
								<div class="col s12 m6 l6">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Healthcare Facility</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap health-facility-checked" name="healthcare_facility_disable"    type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap health-facility-unchecked" name="healthcare_facility_disable"  disabled  value="0" type="radio" disabled>
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">On sight Doctor</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap doctor-checked" name="doctor_disable"   type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap doctor-unchecked" name="doctor_disable"   value="0" type="radio" disabled>
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6 ">On sight Day Care</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap day-care-checked" name="day_care_disable" class="" type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap day-care-unchecked" name="day_care_disable" class="" value="0" type="radio" disabled>
										<span>No</span>
										</label>
									</div>
								</div>
								<div class="col s12 m6 l6">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Playground</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap playground-checked" name="playground_disable"    type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap playground-unchecked" name="playground_disable"    value="0" type="radio" disabled>
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Maternity Leave</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap maternity-leave-checked" name="maternity_leave_disable"  type="radio" value="1" >
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap maternity-leave-unchecked" name="maternity_leave_disable"  type="radio" value="0" >
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Social work</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap social-work-checked" name="social_work_disable"   type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap social-work-unchecked" name="social_work_disable"   type="radio" value="0"disabled >
										<span>No</span>
										</label>
									</div>
								</div>
								@endif
                            </div>

								
							<div class="row worker_welfare_box">
								<div class="row top_titleWrap">
									<div class="col s6 m6">
										<h3>Security and others</h3>
									</div>
									<div class="col s6 m6 right-align editBox">
										<button type="button" data-target="security-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
									</div>
								</div>

								@if($business_profile->security)
								<div class="col s12 m6 l7">
								    @foreach(json_decode($business_profile->security->security_and_others) as $securityAndOther)
									@if($securityAndOther->name == 'fire_exit')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Fire Exit</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire_exit"  class="fire-exit-checked"  type="radio" value="1" {{  ($securityAndOther->checked == "1" ? ' checked' : '') }} disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire_exit" class="fire-exit-unchecked"    value="0" type="radio" {{  ($securityAndOther->checked == "0" ? ' checked' : '') }} disabled>
										<span>No</span>
										</label>
							
									</div>
									@endif
									@if($securityAndOther->name == 'fire_hydrant')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">On sight Fire Hydrant</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire_hydrant"  class="fire-hydrant-checked"  type="radio" value="1" {{  ($securityAndOther->checked == "1" ? ' checked' : '') }} disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire_hydrant" class="fire-hydrant-unchecked"  value="0" type="radio" {{  ($securityAndOther->checked == "0" ? ' checked' : '') }} disabled>
										<span>No</span>
										</label>
									</div>
									@endif
									@if($securityAndOther->name == 'water_source')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6 ">Onsight water source</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="water_source" class="water-source-checked" type="radio" value="1" {{  ($securityAndOther->checked == "1" ? ' checked' : '') }} disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="water_source" class="water-source-unchecked" value="0" type="radio" {{  ($securityAndOther->checked == "0" ? ' checked' : '') }} disabled>
										<span>No</span>
										</label>
									</div>
									@endif
								    @endforeach
							    </div>

								<div class="col s12 m6 l5">
									@foreach(json_decode($business_profile->security->security_and_others) as $securityAndOther)
									@if($securityAndOther->name == 'protocols')
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Other protocols</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="protocols" class="protocols-checked"   type="radio" value="1" {{  ($securityAndOther->checked == "1" ? ' checked' : '') }} disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="protocols"  class="protocols-unchecked"  value="0" type="radio" {{  ($securityAndOther->checked == "0" ? ' checked' : '') }} disabled>
										<span>No</span>
										</label>
									</div>
									@endif
									@endforeach
								</div>
								@else
								<div class="col s12 m6 l7">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Fire Exit</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire-exit" class="fire-exit-checked"   type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire-exit" class="fire-exit-unchecked"   type="radio" value="0" disabled>
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">On sight Fire Hydrant</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="fire-hydrant" class="fire-hydrant-checked"   type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap"  name="fire-hydrant" class="fire-hydrant-unchecked"   type="radio" value="0" disabled>
										<span>No</span>
										</label>
									</div>
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Onsight water source</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap"  name="water-source" class="water-source-checked"   type="radio" value="1"  checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="water-source" class="water-source-unchecked"   type="radio" value="0" disabled>
										<span>No</span>
										</label>
									</div>
								</div>
								<div class="col s12 m6 l5">
									<div class="welfare_box row">
										<span class="title col s8 m6 l6">Other protocols</span>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="protocols" class="protocols-checked"   type="radio" value="1" checked="" disabled>
										<span>Yes</span>
										</label>
										<label class="radio_box col s2 m2 l2">
										<input class="with-gap" name="protocols" class="protocols-unchecked"   type="radio" value="0" disabled>
										<span>No</span>
										</label>
									</div>
								</div>
								@endif
							</div>
						</div>
						<div class="overview_table_wrap blank_overview_table_">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Sustainability commitments</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="sustainability-commitment-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
								</div>
							</div>
							<div class="overview_table box_shadow">
								<table>
									<tbody class="sustainability-commitment-table-body">
											@if(count($business_profile->sustainabilityCommitments))
												@foreach($business_profile->sustainabilityCommitments as $sustainabilityCommitment)
												<tr>
													<td>{{$sustainabilityCommitment->title}}</td>
													@if($sustainabilityCommitment->status==1)
													<td><i class="material-icons" style="color:green">check_circle</i></td>
													@else
													<td><i class="material-icons "style="color:gray">check_circle</i></td>
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
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="association-membership-upload-form-modal" class="btn_upload btn_green_White modal-trigger"><span class="material-icons">file_upload</span></span> Upload</button>
									<button type="button" class="btn_delete btn_green_White delete-association-membership-button"><span><span class="material-icons">delete</span></span> Delete</button>
								</div>
							</div>
							<div class="row membership_textBox association-membership-block">
								@if(count($business_profile->associationMemberships)>0)
							    @foreach($business_profile->associationMemberships as $associationMembership)
								<div class="col s12 m6 l5 center-align association-membership-img">
									<a href="javascript:void(0)" style="display: none;"data-id="{{$associationMembership->id}}" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>
									<div class="imgbox"><img  src="{{ asset('storage/'.$associationMembership->image) }}" alt=""></div>
									<p>{{$associationMembership->title}}</p>
								</div>
								@endforeach
								@else
								<div class="card-alert card cyan lighten-5">
									<div class="card-content cyan-text">
										<p>INFO : No data found.</p>
									</div>
								</div>
								@endif
							</div>
						</div>
						<div class="pr_highlights_wrap">
							<div class="row top_titleWrap upload_delete_wrap">
								<div class="col s6 m6">
									<h3>PR Highlights</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button type="button" data-target="press-highlight-upload-form-modal" class="btn_upload btn_green_White modal-trigger"  ><span class="material-icons">file_upload</span></span> Upload</button>
									<button type="button" class="btn_delete btn_green_White delete-press-highlight-button" ><span><span class="material-icons">delete</span></span> Delete</button>
								</div>
							</div>
							<div class="row press-highlight-block">
							@if(count($business_profile->pressHighlights)>0)
							@foreach($business_profile->pressHighlights as $pressHighlight)
								<div class="col s6 m4 l2 paper_img press-highlight-img">
									<a href="javascript:void(0)" style="display: none;"data-id="{{$pressHighlight->id}}" class="remove-press-highlight"><i class="material-icons dp48">remove_circle_outline</i></a>
									<div class="press_img">
										<img src="{{ asset('storage/'.$pressHighlight->image) }}" alt="" />
									</div>
								</div>
							@endforeach
							@else
								<div class="card-alert card cyan lighten-5">
									<div class="card-content cyan-text">
										<p>INFO : No data found.</p>
									</div>
								</div>
							@endif
								
							</div>
						</div>
					</div>
					<div id="products" class="tabcontent">

						<div class="col m12 add-new-product-button">
							<a href="javascript:void(0);" class="modal-trigger tooltipped product-add-modal-trigger btn waves-effect waves-light green btn_green" data-position="top" data-tooltip="add new product">
								<i class="material-icons dp48">add</i> Add New product
							</a>
						</div>
						<div id="manufacture_edit_errors"></div>
						<div class="manufacture-product-table-data">
							@include('business_profile._product_table_data')
						</div>
					
						<!--div class="profile_products_wrap">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Main Products</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button class="btn_green">Add new Product</button>
								</div>
							</div>
							<div class="profile_products_gallery">
								<div class="row products_gallery_women">
									<div class="col s12 m8 l9">
										<div class="row">
											<div class="col s12 m6 l7 gallery_leftimgs">
												<div class="profile_products_imgWrap">
													<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/sayem_02.jpeg')}}" alt=""/></div>
													<div class="gallery_textbox">
														<h5><span>Women's</span> Sweaters</h5>
													</div>
												</div>
												<div class="profile_products_imgWrap">
													<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/sayem_01.jpg')}}" alt=""/></div>
													<div class="gallery_textbox">
														<h5><span>Women's</span> Fullsleeves</h5>
													</div>
												</div>
											</div>
											<div class="col s12 m6 l5 gallery_midimgs">
												<div class="profile_products_imgWrap">
													<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/sayem_4.png')}}" alt=""/></div>
													<div class="gallery_textbox">
														<h5><span>Women's</span> Fullsleeves</h5>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col s12 m4 l3 gallery_rightimgs">
										<div class="profile_products_imgWrap">
											<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/sayem_04.jpeg')}}" alt=""/></div>
											<div class="gallery_textbox">
												<h5><span>Women's</span> Sweatshirts</h5>
											</div>
										</div>
										<div class="profile_products_imgWrap">
											<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/sayem_01.jpg')}}" alt=""/></div>
											<div class="gallery_textbox">
												<h5><span>Women's</span> Hoodies</h5>
											</div>
										</div>
									</div>
								</div>
								<div class="row products_gallery_men">
									<div class="col s12 m5 l5">
										<div class="profile_products_imgWrap">
											<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/sayem_02.jpeg')}}" alt=""/></div>
											<div class="gallery_textbox">
												<h5><span>Men's</span> Down Jackets</h5>
											</div>
										</div>
									</div>
									<div class="col s12 m7 l7">
										<div class="profile_products_imgWrap">
											<div class="gallery_img"><img src="{{asset('images/frontendimages/new_layout_images/best_mens_hoodies.png')}}" alt=""/></div>
											<div class="gallery_textbox">
												<h5><span>Men's</span> Hoodies</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div-->
					</div>
					<!--div id="womenproducts" class="tabcontent">
						<div class="tab_navMenu">
							<ul>
								<li><a href="javascript:void(0);">Main Products</a></li>
								<li>Women's Sweaters</li>
							</ul>
						</div>
						<div class="profile_product_wrap product_wrapper">
							<div class="row top_titleWrap">
								<div class="col s6 m6">
									<h3>Women's Sweaters</h3>
								</div>
								<div class="col s6 m6 right-align editBox">
									<button class="btn_green">Add new Product</button>
								</div>
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
					</div-->
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
    
    @include('business_profile._edit_company_overview_modal')
    @include('business_profile._edit_capacity_and_machineries_modal')
    @include('business_profile._edit_production_flow_and_manpower_modal')
    @include('business_profile._upload_certifications_modal')
	@include('business_profile._upload_main_buyers_modal')
	@include('business_profile._upload_export_destination_modal')
	@include('business_profile._upload_association_membership_modal')
	@include('business_profile._add_business_terms_modal')
	@include('business_profile._add_sampling_modal')
	@include('business_profile._add_special_customization_modal')t
	@include('business_profile._add_sustainability_commitment_modal')
	@include('business_profile._add_worker_walfare_and_csr_modal')
	@include('business_profile._add_security_modal')
	@include('business_profile._upload_press_highlight_modal')
    @include('business_profile._add_product_modal')
    @include('business_profile._edit_product_modal')
@endsection

@include('business_profile._scripts')

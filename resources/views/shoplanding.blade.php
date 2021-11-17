
@extends('layouts.app_containerless')

@section('content')

<!-- Banner section start  -->
<section class="bannerwrap">
	<div class="banner_slider">
		<div class="banner_inner">
			<h2>Search with Trust</h2>
			<div class="banner_search">

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
				
			</div>
			<span class="search_verified">Search with trust from the largest verified supplier database of Bangladesh.</span>
		</div>
	</div>
</section>
<!-- Banner section end  -->
<!-- Main Container start -->
<section class="mainContainer">
	<div class="container">
		<div class="product_wrapper">
			<div class="product_innrer_wrap box_shadow">
				<h2 class="center-align">New Designs</h2>
				<div class="product_view right-align"><a href="{{route('buydesignsproducts')}}"> View all </a></div>
				<div class="product_slider product_boxwrap">

					@if(count($buyDesignsProducts) > 0)
						@foreach($buyDesignsProducts as $key=>$product)
							<div class="productBox col s6 m3 l3">
								<div class="imgBox">
									@foreach($product->images as $key=>$image)
										<img src="{{asset('storage/'.$image->image)}}" class="single-product-img" alt="" />
										@break
									@endforeach
									<div class="favorite">
										<a href="javascript:void(0);" id="favorite" data-productSku="{{$product->sku}}" class="product-add-wishlist">
											<i class="material-icons dp48">favorite</i>
										</a>                        
									</div>
								</div>
								<div class="priceBox row">
									<div class="col m5 s5 apperal">Apperal</div>
									<!--div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div-->
									<div class="price col m7 s7 right-align">@include('product._product_price')</div>
								</div>
								<h4>
									<a href="{{route('productdetails',$product->sku)}}">
										{{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}
									</a>                     
								</h4>      
								<div class="moq" style="display: none;">MOQ  150 <span>pcs</span></div>
								<div class="leadTime" style="display: none;">Lead time 10 <span>days</span></div>
							</div>
						@endforeach
					@else
						No Products found.
					@endif				

					
				</div>
			</div>
			<div class="product_innrer_wrap box_shadow" style="display: none;">
				<h2 class="center-align">New Arrivals</h2>
				<div class="product_view right-align"><a href="#"> View all </a></div>
				<div class="product_slider product_boxwrap">
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product2.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
			<div class="product_innrer_wrap box_shadow">
				<h2 class="center-align">Ready Stock</h2>
				<div class="product_view right-align"><a href="{{route('readystockproducts')}}"> View all </a></div>
				<div class="product_slider product_boxwrap">
					@if(count($readyStockProducts) > 0)
						@foreach($readyStockProducts as $key=>$product)
							<div class="productBox col s6 m3 l3">
								<div class="imgBox">
									@foreach($product->images as $key=>$image)
										<img src="{{asset('storage/'.$image->image)}}" class="single-product-img" alt="" />
										@break
									@endforeach
									<div class="favorite">
										<a href="javascript:void(0);" id="favorite" data-productSku="{{$product->sku}}" class="product-add-wishlist">
											<i class="material-icons dp48">favorite</i>
										</a>                        
									</div>
									@if($product->availability==0 && ($product->product_type==2 || $product->product_type==3))
									<div class="sold-out"><h4>Sold Out</h4></div>
									@endif                    
								</div>
								<div class="priceBox row">
									<div class="col m5 s5 apperal">Apperal</div>
									<!--div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div-->
									<div class="price col m7 s7 right-align">@include('product._product_price')</div>
								</div>
								<h4>
									<a href="{{route('productdetails',$product->sku)}}">
										{{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}
									</a>                     
								</h4>      
								<div class="moq" style="display: none;">MOQ  150 <span>pcs</span></div>
								<div class="leadTime" style="display: none;">Lead time 10 <span>days</span></div>
							</div>
						@endforeach
					@else
						No Products found.
					@endif
				</div>
			</div>
			<div class="product_innrer_wrap box_shadow" style="display: none;">
				<h2 class="center-align">Low MOQ</h2>
				<div class="product_view right-align"><a href="#"> View all </a></div>
				<div class="product_slider product_boxwrap">
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product2.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
			<div class="product_innrer_wrap box_shadow" style="display: none;">
				<h2 class="center-align">Shortest Lead Time</h2>
				<div class="product_view right-align"><a href="#"> View all </a></div>
				<div class="product_slider product_boxwrap">
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product2.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
			<div class="product_innrer_wrap box_shadow" style="display: none;">
				<h2 class="center-align">Customizablee</h2>
				<div class="product_view right-align"><a href="#"> View all </a></div>
				<div class="product_slider product_boxwrap">
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product2.jpg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product1.jpg')}}"></a>
							<div class="favorite"><span class="material-icons">favorite</span></div>
							<div class="sold-out">
								<h4>Sold Out</h4>
							</div>
						</div>
						<div class="priceBox row">
							<div class="col m5 s5 apperal">Apperal</div>
							<div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div>
						</div>
						<h4>Winter Autumn Casual Outwear Casual Knitted Crew Neck Winter Autumn Casual Outwear Casual Knitted Crew Neck</h4>
						<div class="moq">MOQ  150 <span>pcs</span></div>
						<div class="leadTime">Lead time 10 <span>days</span></div>
					</div>
					<div class="productBox">
						<div class="imgBox card">
							<a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/product3.jpeg')}}"></a>
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
		</div>
	</div>
</section>
<!-- Main Container end -->

@endsection


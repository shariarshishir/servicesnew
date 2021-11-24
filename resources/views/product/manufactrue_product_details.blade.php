@extends('layouts.app')
@section('content')
@include('sweet::alert')
    <div class="row">
    <section class="">
        <div class="container">
            <div class="row ic-breadcrumb">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">All Categories</a></li>
                        <li><a href="#">{{ $product->category['name'] }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="ic-single-product-details">
        <div class="container">
            <div class="row">
                <div class="ic-pg-container">
                    <div class="col-md-4">
                        <div class="simpleLens-gallery-container" id="ic-gallery">
                            @if(isset($product->product_images[0]['product_image']) && !is_null($product->product_images[0]['product_image']))
                                <div class="simpleLens-container">
                                    <div class="simpleLens-big-image-container">
                                        <a class="simpleLens-lens-image" data-lens-image="{{ asset('storage/'. $product->product_images[0]['product_image']) }}">
                                            <img id="largeImage" src="{{ asset('storage/'. $product->product_images[0]['product_image']) }}" class="simpleLens-big-image" width="380px" height="320px">
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="simpleLens-thumbnails-container">
                                @foreach($product->product_images as $product_image)
                                    <a href="javascript:void(0)" class="simpleLens-thumbnail-wrapper"
                                       data-lens-image="{{ asset('storage/'.$product_image['product_image']) }}"
                                       data-big-image="{{ asset('storage/'.$product_image['product_image']) }}">
                                        <img src="{{ asset('storage/'.$product_image['product_image']) }}" style="width:80px !important; height:80px !important; margin-top:4px;" id="smallImages[]" />
                                    </a>
                                @endforeach


                                @php $productImage = (!empty($product->product_images[0]->product_image))?asset('storage/' .$product->product_images[0]->product_image):asset('images/supplier.png'); @endphp
                            </div>

                        </div>
                        <div>
                            @if(auth()->check() && in_array(auth()->user()->user_type, ['buyer', 'both']))
                                @if(check_wishlist($product->id, 'product'))
                                    <a href="{{ action('WishListController@removeWishlist', ['id'=>$product->id, 'type'=>'product']) }}" class="btn btn-danger" style="margin-top: 10px;">Remove from wishlist</a>
                                @else
                                    <a href="{{ action('WishListController@addToWishlist', ['id'=>$product->id, 'type'=>'product']) }}" class="btn btn-success" style="margin-top: 10px;">Add to wishlist</a>
                                @endif
                            @endif
                        </div>
                    </div>


                    <div class="col-md-5 col-sm-12 ic-product-infobox">
                        <div class="ic-product-details">

                            {{-- <form id="productOrderForm" action="{{ route('orders.placeing', $product->id) }}" method="POST" style="padding:10px 15px"> --}}

                                <h2 class="ic-product-title">{{ $product->title }}</h2>

                                <table class="table table-bordered-less">
                                    <tbody>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>:</th>
                                            <td>mb-{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price per Unit</th>
                                            <th>:</th>
                                            <td>{{getlocalpriceunit()}} {{ getlocalprice($product->price_per_unit) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lead Time</th>
                                            <th>:</th>
                                            <td>{{ $product->lead_time }} days</td>
                                        </tr>
                                        <tr>
                                            <th>Min Quantity</th>
                                            <th>:</th>
                                            <td>{{ $product->moq }}</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div>

                                @php
                                    $colors = $product->colors ?? [];
                                    $sizes = $product->sizes ?? [];
                                @endphp

                                @if( !empty($colors) && is_array($colors) && !empty($sizes) && is_array($sizes) )

                                    <div class="mycolorwrapper">
                                        <h3>Colors: <span id="mycolorboxColor">&nbsp;</span></h3>
                                        <div class="mycolorboxs">

                                            @foreach($colors as $idx=>$color)
                                            <label class="mycolorbox">
                                                <input type="hidden" class="mycolorbox-input{{ ($idx===0)? ' active' : '' }}" id="colorbox_{{ $color }}" name="colors[]" value="{{ $color }}" data-target="#mysizeboxPanel_{{ $color }}">
                                                <span class="mycolorbox-color" style="background-color:{{ strtolower($color) }}">&nbsp;</span>
                                            </label>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="mysizewrapper">
                                        <h3>Sizes</h3>
                                        <div class="mysizeboxs">

                                            @foreach($colors as $idx=>$color)

                                            <div id="mysizeboxPanel_{{ $color }}" data-color="{{ $color }}" class="mysizebox-panel{{ ($idx===0)? ' itChecked' : '' }}" style="display:{{ ($idx===0)? 'block' : 'none' }}">

                                                @foreach($sizes as $size)

                                                <div class="mysizebox" data-size="{{ $size }}">
                                                    <h5>{{ strtoupper($size) }}</h5>
                                                    <div class="inr-mysizebox" data-size="{{ $size }}">
                                                        <button type="button" class="js-increment" data-type="increment"><i class="fa fa-fw fa-plus"></i></button>
                                                        <input type="number" name="sizes[{{ str_replace(' ', '_', $color) }}][{{  str_replace(' ', '_', $size) }}]" data-color="{{ $color }}" data-size="{{ $size }}" value="0" min="0">
                                                        <button type="button" class="js-decrement" data-type="decrement"><i class="fa fa-fw fa-minus"></i></button>
                                                    </div>
                                                </div>

                                                @endforeach


                                            </div>

                                            @endforeach
                                        </div>

                                        <div style="padding:20px 0;display:none">
                                            <table id="quantityTable" class="table table-qty">
                                                <thead>
                                                    <tr>
                                                        <th>COLOR</th>

                                                        @foreach ($sizes as $size)
                                                            <th>{{ strtoupper($size) }}</th>
                                                        @endforeach

                                                        <th>QTY</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($colors as $color)

                                                        <tr class="row_{{ $color }}" data-color="{{ $color }}">
                                                            <th>{{ ucfirst($color) }}</th>

                                                            @foreach($sizes as $size)

                                                                <td class="{{ $color }}_{{ $size }}" data-color="{{ $color }}" data-size="{{ $size }}">0</td>

                                                            @endforeach

                                                            <td class="{{ $color }}_QTY" data-color="{{ $color }}" data-size="QTY">0</td>
                                                        </tr>

                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr class="row_total">
                                                        <th>Totoal</th>

                                                        @foreach($sizes as $size)

                                                            <td class="total_{{ $size }}" data-size="{{ $size }}">0</td>

                                                        @endforeach

                                                        <td class="total_QTY" data-size="QTY">0</td>
                                                    </tr>
                                                </tfoot>

                                                {{-- <tfoot>
                                                    <tr>
                                                        <td><input type="text" size="1" name="total_qty" id="total_qty" value="0" readonly required></td>
                                                        <td>${{ $product->price_per_unit }}</td>
                                                        <td>$<input type="text" size="1" name="total_price" id="total_price" value="0" readonly required></td>
                                                    </tr>
                                                </tfoot> --}}
                                            </table>
                                        </div>
                                    </div>

                                    @endif

                                </div>


                                <div id="place_order_buttons" class="ic-place-order">
                                    {{-- <a href="{{ route('wishlist.store',[$product->id,'product']) }}" class="ic-btn" style="margin-right:10px"><i class="fa fa-heart-o"></i></a> --}}

                                    @if( !empty($colors) && is_array($colors) && !empty($sizes) && is_array($sizes) )
                                        @csrf

                                        <input type="hidden" id="total_qty2" name="quantity" value="0">
                                        <button type="button" class="ic-btn js__btn" data-toggle="modal" data-target="#productOrderModal" disabled>Place order</button>

                                    @else

                                        {{-- <a href="#" class="ic-btn" data-toggle="modal" data-target="#product-order"></a> --}}
                                        {{-- <a href="{{ action('ProductController@contactSupplier', $product->id) }}" class="ic-btn">Place order</a> --}}


                                    @endif
                                    {{-- @if($user != null)
                                        @if($user->user_type == "buyer")
                                            <button type="button" class="ic-btn" onClick="sendmessage()">Contact supplier</button>
                                        @endif
                                    @else
                                        <button type="button" class="ic-btn" data-toggle="modal" data-target="#contactSupplierModal">Contact supplier</button>
                                    @endif --}}
                                    <br/>

                                </div>
                            </form>

                            <div class="samplebox">
                                <div>
                                    <a class="ic-sbtn" href="#requestSampleForm">Request Sample</a>
                                    <p>contact for order customization or bulk volume rate-</p>
                                </div>
                                <form class="sampleformbox" id="requestSampleForm" action="{{ route('products.requestSample') }}" method="POST">
                                    @csrf
                                    <div class="inrsampleformbox">
                                        <h5>Request Sample <button type="button" class="ic-btnclose">&times;</button></h5>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Name*" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email Address*" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="address" placeholder="Address*" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="sample_details" rows="3" placeholder="Sample details"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">SEND</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="ic-product-footer" style="">

                                <button class="ic-btn" data-toggle="modal" data-target="#merchantAssistanceModal">Merchant Assistance </button>


                                <p style="margin-left:40px; color:white;">
                                    <img src="{{ asset('storage/images/trade-security.png') }}" width="40px" height="40px" alt=""/> <span style="font-size:12px;" >Get Trade Security</span>

                                    <img src="{{ asset('storage/images/best-price.png') }}" width="40px" height="40px" alt=""/> <span   style="font-size:12px;">Best Price</span>
                                </p>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div style="height: 320px; background-color: #f9f9f9;">


                            <div class="row" style="height:90px; background-image: url({{ asset('images/single-product-logo-background.jpg') }}); background-repeat: no-repeat;">
                                <div class="col-md-12">
                                    @if(isset($supplier->profile->company_logo))
                                        <img src="{{ asset('storage/'.$supplier->profile->company_logo) }}" width="30%" height="70px" alt="Missing" style="border-radius: 190px; margin-top:50px; margin-left:90px;" />
                                    @endif
                                </div>
                            </div>

                            <p class="text-center" style="font-size: 16px; font-weight:bold;"><span style=" color: #333333;"> {{ @$supplier->profile->company_name }}</span></p>

                            <p class="text-center">{{ @$supplier->profile->company_info['city'] }}, {{ @$supplier->profile->company_info['country'] }}</p>

                            <div class="ic-badges" style="padding-left: 16px;">
                                @foreach($supplier->badges as $badge)
                                    <p><img src="{{ asset('storage/'.$badge->badge['image']) }}" alt="right" style="width:40px;">
                                    {{ $badge->badge->name }}</p>
                                @endforeach
                            </div>


                            <br/><br/>
                            <span class="col-md-3"></span>
                            <a href="#" class="text-center ic-primary">View Company Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

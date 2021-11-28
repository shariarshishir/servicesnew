@extends('layouts.app')
@section('content')
@include('sweet::alert')
@php
$relatedProducts = relatedProductInformation($product->id);
$productReviews = singleProductReviewInformation($product->id);
$reviewsCount = count($productReviews);
@endphp
<input type="hidden" name="product_sku" value="{{$product->sku}}">
@if ($orderModificationRequest->isNotEmpty())
<div class="card-alert card cyan">

    <div class="card-content white-text">
        <p>INFO : You have already sent modification request for this product.</p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

<div class="product_details_wrapper">
    <div class="single-product-details-block-wrapper">
        <div class="product_details_title_box">
            <h3>{{ $product->name }}</h3>
            <div class="product_stock">
                <div class="single-product-availability">Availability: <span>instock</span></div>
            </div>
        </div>
        <div class="row product_details_content_wrap">
            <div class="col m3 product_preview_wrap">
                <div class="product-images">
                    <div class="product-main-image">
                        <div class="product-large-image-block product_details_imgwrap">
                            @if(count($product->images)> 0)
                                @foreach ($product->images as $image)
                                    <div>
                                        <center>
                                            <a data-fancybox="gallery" href="{{asset('storage/'.$image->original)}}">
                                                <img src="{{asset('storage/'.$image->image)}}" class="responsive-img" width="300px"/>
                                                
                                                <div class="click-to-zoom">
                                                    <i class="material-icons dp48">zoom_in</i> 
                                                    <!-- Click on image to view large size. -->
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <ul class="product-list-images-block">
                    @if(count($product->images)> 0)
                        @foreach ($product->images as $image)
                            <li><a href="javascript:void(0);"><img src="{{asset('storage/'.$image->image)}}" class="responsive-img" width="100px" /></a></li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
            <div class="@php echo ($relatedProducts->isNotEmpty()) ? 'col m5':'col s12 m9 l9 product_preview_info_wrap' @endphp single-product-details-wrapper">
                <div class="row">
                    <div class="col s12 m8 l8 product_details_info_wrap">
                        <div class="row">
                            <div class="col s12 m6 l6 left-align">
                                <div class="seller-store">
                                    <a href="#"> {{$product->businessProfile->business_name}}</a>
                                    {{-- <a href="{{ route('users.myshop',$product->vendor->vendor_uid) }}"><i class="material-icons dp48">store</i> {{ $product->vendor->vendor_name }}</a> --}}
                                </div>
                            </div>
                            <div class="col s12 m6 l6 right-align">
                                <!-- <button class="btn_grBorder">Full Stock only</button> -->
                            </div>
                        </div>

                        <!-- <div class="product_description">
                            {!! $product->description !!}
                        </div> -->

                        

                        <!-- <h4>{{ $product->name }}</h4> -->
                        <div class="row single-product-details-top">
                            <div class="col m12">
                                
                                @if($product->availability==0 && ($product->product_type==2 || $product->product_type== 3))
                                    <span class="new badge red" data-badge-caption="Sold Out"></span>
                                @endif
                                @if($product->full_stock== 1)
                                    <span class="badge badge pill blue accent-2 mr-2 ready-to-ship-label btn_grBorder">Full Stock</span>
                                @else

                                    <div class="single-product-moq">
                                        MOQ: <span> {{ $product->moq }} </span><span class="unit">{{$product->product_unit}} </span>
                                    </div>
                                    <div class="single-product-price">
                                        <div class="label">Price:</div>
                                        <div class="single-product-price-value">
                                            @php
                                                $count= count(json_decode($product->attribute));
                                                $count = $count-2;
                                            @endphp
                                            <span class="price_negotiable">
                                                @foreach (json_decode($product->attribute) as $k => $v)
                                                    @if($k == 0 && $v[2] == 'Negotiable')
                                                    {{ 'Negotiable' }}
                                                    @endif
                                                    @if($loop->last && $v[2] != 'Negotiable')
                                                        ${{ $v[2] }}
                                                    @endif
                                                    @if($loop->last && $v[2] == 'Negotiable')
                                                        @foreach (json_decode($product->attribute) as $k => $v)
                                                                @if($k == $count)
                                                                    ${{ $v[2]  }} {{ 'Negotiable' }}
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </span>
                                            <!-- <a href="javascript:void(0);" class="show_attr_trigger show_more_price_options btn_grBorder">Show more</a>
                                            <div class="col-md-12" id="attr-block" style="display: none;"> -->
                                            <div class="col-md-12" id="attr-block">
                                                <div class="ready_order_attr_block">
                                                    <table style="border: 1px solid #ccc;" class="fresh-order-attributes">
                                                        <tr>
                                                            <td>Quantity({{$product->product_unit}})</td>
                                                            <td>Price</td>
                                                            @if($product->product_type==1) <td>Lead Time </td>@endif
                                                        </tr>
                                                        @foreach($attr as $key=>$list)
                                                        <tr class="ready_attr_data">
                                                            <td class="price-range-block"><span class="min-price">{{$list[0]}}</span> <span class="price-range-separator">-</span> <span class="max-price">{{$list[1]}}</span></td>
                                                            <td>{{$list[2]}}</td>
                                                            @if($product->product_type==1) <td>{{$list[3]}} </td>@endif
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($product->customize == true)
                                        <span class="badge badge pill blue accent-2 mr-2 ready-to-ship-label tooltipped" data-position="top" data-tooltip="Please click on request for modification to customize this product.">Can be Customized</span>
                                    @endif
                                @endif

                                <!-- <div class="single-product-review-stars">
                                    <div class="star-rating" data-score="{{$averageRating}}"></div>
                                    <span>{{$averageRating}} out of 5</span>
                                </div> -->

                            </div>
                        </div>

                        <div class="row single-product-details-bottom">
                            <div class="col m12">
                                <div class="single-product-details" style="display: none;">
                                {!! $product->description !!}
                                </div>
                                <div class="single-product-attributes">

                                    @if($product->product_type==2 || $product->product_type== 3)
                                        <div class="single-product-colors">
                                            <span>Available Colors:</span>
                                            <ul>
                                                @foreach($colors_sizes as $color)
                                                <li><a href="javascript:void(0);">{{$color->color}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($product->product_type==1)
                                        <div class="single-product-add-to-cart">
                                            {{-- <div class="cart-item-block">
                                                <button type="button" id="trigger_minus" class="trigger_minus btn green"><i class="material-icons dp48">remove</i></button>
                                                <input type="number" name="fresh_input" class="fresh_input_value" value="0" min="1" />
                                                <button type="button" id="trigger_plus" class="trigger_plus btn green"><i class="material-icons dp48">add</i></button>
                                            </div> --}}
                                            <div class="fresh_order_block_wrapper">
                                                <a class="waves-effect waves-light modal-trigger customaize_order_trigger" href="#fresh_order_customize_block">Customaize Your Order</a>
                                                @if(auth::check())
                                                    <a class="waves-effect waves-light modal-trigger request_order_modification_trigger" href="#product-modification-modal">Request for Modification</a>
                                                @else
                                                    <a class="waves-effect waves-light modal-trigger request_order_modification_trigger" href="#login-register-modal">Request for Modification</a>
                                                @endif
                                            </div>
                                            <div id="fresh_order_customize_block" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <table class="color-size-table-block striped" width="100%" cellpadding="0" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>Color</th>
                                                                <th>XXS</th>
                                                                <th>XS</th>
                                                                <th>Small</th>
                                                                <th>Medium</th>
                                                                <th>Large</th>
                                                                <th>Extra Large</th>
                                                                <th>XXL</th>
                                                                <th>XXXL</th>
                                                                <th>4XXL</th>
                                                                <th>One Size</th>
                                                                <th>&nbsp;</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="cusotmize-color-size-attr-tbody">
                                                            <tr class="tr">
                                                                <td><input class="combat" type="text" value="" name="color"/></td>
                                                                <td><input class="combat" type="text" value="0" name="xxs" /></td>
                                                                <td><input class="combat" type="text" value="0" name="xs" /></td>
                                                                <td><input class="combat" type="text" value="0" name="small" /></td>
                                                                <td><input class="combat" type="text" value="0" name="medium" /></td>
                                                                <td><input class="combat" type="text" value="0" name="large" /></td>
                                                                <td><input class="combat" type="text" value="0" name="extra_large" /></td>
                                                                <td><input class="combat" type="text" value="0" name="xxl" /></td>
                                                                <td><input class="combat" type="text" value="0" name="xxxl" /></td>
                                                                <td><input class="combat" type="text" value="0" name="four_xxl" /></td>
                                                                <td><input class="combat" type="text" value="0" name="one_size" /></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addFreshOrderColorSize()"><i class="material-icons dp48">add</i> Add More</a>
                                                    <div class="total-price-block" style="display: none;">
                                                        <div class="input-wrapper">
                                                            <label>Total Qty:</label>
                                                            <span class="item_total_qty"></span>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label>Unit Price: $</label>
                                                            <span class="item_unit_price"></span>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label>Total Price: $</label>
                                                            <span class="item_total_price"></span>
                                                        </div>
                                                    </div>
                                                    <div class="price-calculation-notification" style="display: none;">
                                                        <div class="card-alert card cyan">
                                                            <div class="card-content white-text" style="padding: 10px;">
                                                                Please click on calculate price button. To get updated price calculation.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:void(0);" class="waves-effect waves-green btn-flat price-calculation">Calculate Total Price</a>
                                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat update-price-btn green white-text" disabled="disabled">Update</a>
                                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
                                                        <i class="material-icons green-text text-darken-1">close</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->product_type==2)
                                        <div class="ready_stock_block_wrapper">
                                            <div class="row" style="margin-bottom: 0px;">
                                                <div class="col m12 ready_stock left-align">
                                                    <span class="btn_grBorder badge badge pill green accent-2 mr-2 ready-to-ship-label">Ready to Ship</span>
                                                    @if($product->full_stock==1)
                                                    <span class="badge badge pill blue accent-2 mr-2 ready-to-ship-label btn_grBorder">Full Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($product->availability != 0)
                                            <a class="waves-effect waves-light modal-trigger customaize_order_trigger" href="#ready_stock_order_customize_block">Customaize Your Order</a>
                                            @endif
                                            <div id="ready_stock_order_customize_block" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <table class="color-size-table-block striped ready-stock-table-block" width="100%" cellpadding="0" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>Color</th>
                                                                <th>XXS</th>
                                                                <th>XS</th>
                                                                <th>Small</th>
                                                                <th>Medium</th>
                                                                <th>Large</th>
                                                                <th>Extra Large</th>
                                                                <th>XXL</th>
                                                                <th>XXXL</th>
                                                                <th>4XXL</th>
                                                                <th>One Size</th>
                                                                <th>&nbsp;</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="cusotmize-color-size-attr-tbody">
                                                            @if($product->full_stock == 1)
                                                                @foreach($colors_sizes as $color)
                                                                    <tr class="tr">
                                                                        <td>
                                                                            <input class="combat" type="text" value="{{$color->color}}" name="color" readonly />

                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xxs))
                                                                                <input class="combat" type="text" value="{{ $color->xxs }}" name="xxs" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xxs" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xs))
                                                                                <input class="combat" type="text" value="{{$color->xs}}" name="xs" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xs" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->small))
                                                                                <input class="combat" type="text" value="{{$color->small}}" name="small" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="small" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->medium))
                                                                                <input class="combat" type="text" value="{{$color->medium}}" name="medium" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="medium" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->large))
                                                                                <input class="combat" type="text" value="{{$color->large}}" name="large" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="large" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->extra_large))
                                                                                <input class="combat" type="text" value="{{$color->extra_large}}" name="extra_large" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="extra_large" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xxl))
                                                                                <input class="combat" type="text" value="{{$color->xxl}}" name="xxl" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xxl" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xxxl))
                                                                                <input class="combat" type="text" value="{{$color->xxxl}}" name="xxxl" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xxxl" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->four_xxl))
                                                                                <input class="combat" type="text" value="{{$color->four_xxl}}" name="four_xxl" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="four_xxl" readonly />

                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->one_size))
                                                                                <input class="combat" type="text" value="{{$color->one_size}}" name="one_size" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="one_size" readonly />

                                                                            @endif
                                                                        </td>
                                                                    </tr>

                                                                @endforeach
                                                            @else
                                                                @foreach($colors_sizes as $color)
                                                                    <tr class="tr">
                                                                        <td>
                                                                            <input class="combat" type="text" value="{{$color->color}}" name="color" readonly />
                                                                            <span class="avl-wrap">&nbsp;</span>
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xxs))
                                                                                <input class="combat" type="text" value="0" name="xxs" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->xxs}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xxs" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xs))
                                                                                <input class="combat" type="text" value="0" name="xs" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->xs}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xs" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->small))
                                                                                <input class="combat" type="text" value="0" name="small" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->small}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="small" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->medium))
                                                                                <input class="combat" type="text" value="0" name="medium" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->medium}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="medium" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->large))
                                                                                <input class="combat" type="text" value="0" name="large" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->large}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="large" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->extra_large))
                                                                                <input class="combat" type="text" value="0" name="extra_large" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->extra_large}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="extra_large" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xxl))
                                                                                <input class="combat" type="text" value="0" name="xxl" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->xxl}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xxl" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->xxxl))
                                                                                <input class="combat" type="text" value="0" name="xxxl" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->xxxl}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="xxxl" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->four_xxl))
                                                                                <input class="combat" type="text" value="0" name="four_xxl" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->four_xxl}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="four_xxl" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->one_size))
                                                                                <input class="combat" type="text" value="0" name="one_size" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->one_size}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="one_size" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    <div class="total-price-block" style="display: none;">
                                                        <div class="input-wrapper">
                                                            <label>Total Qty:</label>
                                                            <span class="item_total_qty"></span>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label>Unit Price: $</label>
                                                            <span class="item_unit_price"></span>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label>Total Price: $</label>
                                                            <span class="item_total_price"></span>
                                                        </div>
                                                    </div>
                                                    <div class="price-calculation-notification" style="display: none;">
                                                        <div class="card-alert card cyan">
                                                            <div class="card-content white-text" style="padding: 10px;">
                                                                Please click on calculate price button. To get updated price calculation.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($product->full_stock==1)
                                                        <div class="price-calculation-notification" >
                                                            <div class="card-alert card cyan">
                                                                <div class="card-content white-text" style="padding: 10px;">
                                                                    This is full stock feature Please click on calculate price button. To get updated price calculation.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:void(0);" class="waves-effect waves-green btn-flat price-calculation">Calculate Total Price</a>
                                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat update-price-btn green white-text" disabled="disabled">Update</a>
                                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
                                                        <i class="material-icons green-text text-darken-1">close</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- start non clothing type --}}
                                    @if($product->product_type==3)
                                        <div class="ready_stock_block_wrapper">
                                            <div class="row" style="margin-bottom: 0px;">
                                                <div class="col m12">
                                                    <span class="badge badge pill green accent-2 mr-2 ready-to-ship-label">Ready to Ship</span>
                                                    @if($product->full_stock==1)
                                                    <span class="badge badge pill blue accent-2 mr-2 ready-to-ship-label btn_grBorder">Full Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($product->availability != 0)
                                            <a class="waves-effect waves-light modal-trigger customaize_order_trigger" href="#ready_stock_order_customize_block">Customaize Your Order</a>
                                            @endif
                                            <div id="ready_stock_order_customize_block" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <table class="color-size-table-block striped ready-stock-table-block" width="100%" cellpadding="0" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>Color</th>
                                                                <th>Quantity</th>
                                                                <th>&nbsp;</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="cusotmize-color-size-attr-tbody">
                                                            @if($product->full_stock == 1)
                                                                @foreach($colors_sizes as $color)
                                                                    <tr class="tr">
                                                                        <td>
                                                                            <input class="combat" type="text" value="{{$color->color}}" name="color" readonly />

                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->quantity))
                                                                                <input class="combat" type="text" value="{{ $color->quantity }}" name="non_clothing_quantity" readonly/>

                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="non_clothing_quantity" readonly />

                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                @foreach($colors_sizes as $color)
                                                                    <tr class="tr">
                                                                        <td>
                                                                            <input class="combat" type="text" value="{{$color->color}}" name="color" readonly />
                                                                            <span class="avl-wrap">&nbsp;</span>
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($color->quantity))
                                                                                <input class="combat" type="text" value="0" name="non_clothing_quantity" />
                                                                                <span class="avl-wrap">avl:<span class="avl">{{$color->quantity}}</span></span>
                                                                            @else
                                                                                <input type="text" class="readonly-item" value="0" name="non_clothing_quantity" readonly />
                                                                                <span class="avl-wrap">&nbsp;</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    <div class="total-price-block" style="display: none;">
                                                        <div class="input-wrapper">
                                                            <label>Total Qty:</label>
                                                            <span class="item_total_qty"></span>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label>Unit Price: $</label>
                                                            <span class="item_unit_price"></span>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label>Total Price: $</label>
                                                            <span class="item_total_price"></span>
                                                        </div>
                                                    </div>
                                                    <div class="price-calculation-notification" style="display: none;">
                                                        <div class="card-alert card cyan">
                                                            <div class="card-content white-text" style="padding: 10px;">
                                                                Please click on calculate price button. To get updated price calculation.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($product->full_stock==1)
                                                        <div class="price-calculation-notification" >
                                                            <div class="card-alert card cyan">
                                                                <div class="card-content white-text" style="padding: 10px;">
                                                                    This is full stock feature Please click on calculate price button. To get updated price calculation.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:void(0);" class="waves-effect waves-green btn-flat price-calculation">Calculate Total Price</a>
                                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat update-price-btn green white-text" disabled="disabled">Update</a>
                                                    <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
                                                        <i class="material-icons green-text text-darken-1">close</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                {{-- end non clothing type --}}

                                    <div class="total-price-block" style="display: none;">
                                        <div class="input-wrapper">
                                            <label>Total Qty:</label>
                                            <span class="item_total_qty"></span>
                                        </div>
                                        <div class="input-wrapper">
                                            <label>Unit Price: $</label>
                                            <span class="item_unit_price"></span>
                                        </div>
                                        <div class="input-wrapper">
                                            <label>Total Price: $</label>
                                            <span class="item_total_price"></span>
                                        </div>
                                    </div>

                                    <div id="product-modification-modal" class="modal modal-fixed-footer product-modification-modal">
                                        <div class="modal-content">
                                            <legend>Write your requirement</legend>
                                            <form action="#" method="post" name="prodModReqForm" id="prodModReqForm" enctype="multipart/form-data">
                                                @csrf
                                                <div role="">
                                                    <ul id="pmr-errors"></ul>
                                                </div>
                                                <div class="prod-mod-req-content">
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <textarea id="product-modification-message" class="materialize-textarea product-modification-message" name="prod_mod_req[details][]"></textarea>
                                                            <label for="product-modification-message" class="">Type your modification request.</label>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <label for="product-modification-image" class="product-modification-image">Upload Image</label>
                                                            <input type="file" name="prod_mod_req[image][]" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addProdModReqContent()"><i class="material-icons dp48">add</i> Add More</a>
                                                {{-- <input type="hidden" value="{{$product->vendor->id}}" name="vendor_id" /> --}}
                                                <input type="hidden" value="{{$product->id}}" name="product_id" />
                                                <button type="submit" class="btn green waves-effect waves-light" id="submitProdModReq">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons green-text text-darken-1">close</i></a>
                                        </div>
                                    </div>

                                    <input type="hidden" name="quantity" value="">
                                    <input type="hidden" name="unit_price" value="">
                                    <input type="hidden" name="full_stock" value="{{ $product->full_stock }}">
                                    <input type="hidden" name="total_price" value="">
                                    <input type="hidden" name="product_type" value="{{$product->product_type}}">
                                    @if(Auth::check())
                                    <button id="add_to_cart" data-id="{{$product->sku}}"class="btn waves-effect waves-light green addToCart" onclick="addToCart('{{$product->sku}}')" disabled="disabled">Add to cart</button>
                                    <button id="ask_for_price" data-id="{{$product->sku}}"class="btn waves-effect waves-light green askForPrice" onclick="askForPrice('{{$product->sku}}')" style="display: none">Ask For Price</button>
                                    @else
                                    <a href="#login-register-modal" id="add_to_cart" data-id="{{$product->sku}}"class="btn waves-effect waves-light green addToCart modal-trigger btn_grBorder" disabled="disabled">Add to cart</a>
                                    @endif
                                </div>
                            </div>

                            <div class="col m12 single_product_review_wrap">
                                <span>Rating</span>
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <div class="single-product-review-stars">
                                            <div class="star-rating" data-score="{{$averageRating}}"></div>
                                            <span>{{$averageRating}} out of 5</span>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <div class="single-product-review">
                                            <div class="single-product-write-review">
                                                <ul>
                                                    @if(!$productReviewExistsOrNot && Auth::guard('web')->check())
                                                    <li><a class="btn_grBorder waves-effect waves-light modal-trigger" href="#product-review-modal"><i class="material-icons dp48">edit</i> Write a review</a></li>
                                                    @elseif (!$productReviewExistsOrNot && !Auth::guard('web')->check())
                                                    <li><a class="btn_grBorder waves-effect waves-light modal-trigger" href="#login-register-modal"><i class="material-icons dp48">edit</i> Write a review</a></li>
                                                    @else
                                                    @endif
                                                    <li><a href="javascript:void(0);" class="view-all-review-trigger">View all ({{$reviewsCount}}) review</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="product-review-modal" class="modal modal-fixed-footer">
                                            <div class="modal-content">
                                                <legend>Write your review</legend>
                                                <!--div class="overall-star-rating" data-rateit-value="3.5" data-rateit-ispreset="true" data-rateit-readonly="true"></div-->
                                                <form action="{{route('product.review.store',$product->sku)}}" method="post" name="reviewForm" id="reviewForm">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label>Overall : </label>
                                                            <div id="overall-star-rating" class="score"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label>Communication : </label>
                                                            <div id="communication-star-rating" class="score"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label>On Time Delivery : </label>
                                                            <div id="ontimedelivery-star-rating" class="score"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label>Sample Support : </label>
                                                            <div id="samplesupport-star-rating" class="score"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label>Product Quality : </label>
                                                            <div id="productquality-star-rating" class="score"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <label>Share your experience : </label>
                                                            <textarea id="experience" name="experience" class="experience-textarea materialize-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{$product->businessProfile->id}}" name="business_profile_id" />
                                                    <input type="hidden" value="{{$product->id}}" name="product_id" />
                                                    <button type="submit" class="btn green waves-effect waves-light" id="submitReview">Submit Review</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat "><i class="material-icons green-text text-darken-1">close</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        
                        </div>
                    </div>

                    <div class="col s12 m4 l4">
                        <div class="single-product-store-information center-align">
                            <div class="right-align">
                                <a class="btn_green" href="javascript:void(0);" style="margin-bottom: 30px" >Contact Supplier</a>
                            </div>
                            <div class="card card-with-padding">
                                <h6>Company Profile</h6>
                                <div class="company_profile_details">
                                    <p><b style="color:#4CAF50">Store name :</b> {{$product->businessProfile->business_name}}<p>
                                    <b style="color:#4CAF50">Country / Region :</b> {{$product->businessProfile->location}}<p>
                                    <b style="color:#4CAF50">Business Type :</b> Wholesaler<p>
                                    {{-- <b style="color:#4CAF50">Main Products:</b> {{$product->business_profile->vendor_mainproduct}}<p>
                                    <b style="color:#4CAF50">Total Employees :</b> {{$product->business_profile->vendor_totalemployees}}<p>
                                    <b style="color:#4CAF50">Year Established :</b> {{$product->business_profile->vendor_yearest}}<p>
                                    <b style="color:#4CAF50">Certification :</b> {{$product->business_profile->vendor_certification}}<p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if($relatedProducts->isNotEmpty())
            <div class="col m3 store-more-products">
                <div class="more-products-block col m12">
                    <div class="row">
                        <legend>More Products from this store</legend>
                        @foreach ($relatedProducts as $item)
                        <div class="more-product-item col m12">
                            <div class="product_img">
                                @foreach ($item->images as $image)
                                    <img src="{{asset('storage/'.$image->image)}}" class="responsive-img" alt="" width="100px" />
                                    @break
                                @endforeach
                            </div>
                            <div class="product_short_details">
                                <!--a class="waves-effect waves-light btn modal-trigger" href="#modal3">View</a-->
                                <div class="product-title">
                                    <a href="{{route('productdetails',$item->sku)}}">{{$item->name}}</a>
                                </div>
                                <div class="product_price">
                                    @if($item->full_stock == 1)
                                        <span class="full-stock btn_grBorder">Full Stock</span>
                                    @else
                                        @php
                                            $count= count(json_decode($item->attribute));
                                            $count = $count-2;
                                        @endphp
                                        $ @foreach (json_decode($item->attribute) as $k => $v)
                                            @if($k == 0 && $v[2] == 'Negotiable')
                                            {{ '(Negotiable)' }}
                                            @endif
                                            @if($loop->last && $v[2] != 'Negotiable')
                                                {{ $v[2] }}
                                            @endif
                                            @if($loop->last && $v[2] == 'Negotiable')
                                                @foreach (json_decode($product->attribute) as $k => $v)
                                                        @if($k == $count)
                                                            {{ $v[2]  }} {{ 'Negotiable' }}
                                                        @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="product_info_details">
                                    <div class="star-rating" data-score="0"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row single-product-description-block-wrapper">
        <div class="col s12">
            <ul class="tabs z-depth-1">
                <li class="tab col m3"><a class="active" href="#product-desciprtion">Product Description</a></li>
                <li class="tab col m3"><a href="#product-additional-desciprtion">Additional Information</a></li>
                <li class="tab col m3"><a href="#product-review" class="product-review-tab">Reviews</a></li>
            </ul>
        </div>
        <div id="product-desciprtion" class="col s12">
            <div class="card card-with-padding">
                {!! $product->description !!}
            </div>
        </div>
        <div id="product-additional-desciprtion" class="col s12">
            <div class="card card-with-padding">
                {!! $product->additional_description !!}
            </div>
        </div>
        <div id="product-review" class="col s12">
            <div class="card card-with-padding">

                @if($reviewsCount > 0)
                @foreach($productReviews as $productReview)
                <div class="review-item">
                    <div class="reviewed-by">
                        <div class="user-image">
                            <img src="{{asset('storage/'.$productReview->image)}}" class="responsive-img" width="50px" />
                        </div>
                        <div class="user-name">
                            <span>Reviewd By</span>{{ $productReview->name }}
                        </div>
                    </div>
                    <div class="review-info">
                        <div class="row">
                            <div class="col s12">
                                <label>Overall : </label>
                                <div class="star-rating" data-score="{{ $productReview->overall_rating }}"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>Communication : </label>
                                <div class="star-rating" data-score="{{ $productReview->communication_rating }}"></div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>On Time Delivery : </label>
                                <div class="star-rating" data-score="{{ $productReview->ontime_delivery_rating }}"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>Sample Support : </label>
                                <div class="star-rating" data-score="{{ $productReview->sample_support_rating }}"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>Product Quality : </label>
                                <div class="star-rating" data-score="{{ $productReview->product_quality_rating }}"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>Experience : </label>
                                {{ $productReview->experience }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="card-alert card cyan">
                        <div class="card-content white-text">
                            <p>INFO : Don't have any reviews</p>
                        </div>
                    </div>
            @endif
            </div>
        </div>
    </div>
    <div class="row single-product-related-products">
        <div class="related-products col m12">
            <div class="card-with-padding">
                <legend>Recommended products for you</legend>

                @if(count($recommandProducts)>0)
                <div class="row recommendation-products">
                    @foreach($recommandProducts as $key=>$product)

                    <div class="col s12 m3 l3">
                        <div class="card">
                            <div class="card-content">
                                <div class="product_img">
                                    {{-- <a href="javascript:void();" class="overlay_hover"></a> --}}
                                    @foreach($product->images as $key=>$image)
                                        <img src="{{asset('storage/'.$image->image)}}" class="single-product-img" alt="" />
                                        @break
                                    @endforeach
                                    <div class="product_quick_options">
                                        <a href="{{route('productdetails',$product->sku)}}" class="quick_options_link">&nbsp;</a>
                                        <div class="poduct_quick_options_inside">
                                            <a href="javascript:void(0);" id="favorite" data-productSku="{{$product->sku}}"class="btn waves-effect waves-light green lighten-1 product-add-wishlist">
                                                <i class="material-icons dp48">favorite</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_short_details">
                                    <div class="product-title">
                                        <a href="{{route('productdetails',$product->sku)}}">
                                            {{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}
                                        </a>
                                    </div>
                                    <div class="product_price">
                                        @include('product._product_price')

                                        @if($product->availability==0 && $product->product_type==2)
                                            <span class="new badge red sold-out" data-badge-caption="Sold Out"></span>
                                        @endif
                                    </div>
                                    @php  $averageRating = productRating($product->id);@endphp
                                    <div class="product_info_details">
                                        <div class="shipping_label">Free Shipping</div>
                                        <div class="rating_label">
                                            <i class="material-icons pink-text"> star </i>
                                            <span>{{$averageRating}}</span>
                                        </div>
                                    </div>
                                    <div class="vendor_name">
                                        {{-- <a href="#"> {{$product->businessProfile->business_name}}</a> --}}
                                        {{-- <a href="{{ route('users.myshop',$product->vendor->vendor_uid) }}">{{$product->vendor->vendor_name}}</a> --}}
                                    </div>
                                </div>
                                <!-- Modal Structure -->
                                <div  id="product-details-modal_{{$product->sku}}" class="modal modal-fixed-footer product-details-modal" tabindex="0">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col m6 s12 modal-product-images">
                                            @foreach($product->images as $key=>$image)
                                                <img src="{{asset('storage/'.$image->image)}}" class="responsive-img" alt="" />
                                            @endforeach
                                            </div>
                                            <div class="col m6 s12">
                                                <h5>{{$product->name}}</h5>
                                                <span class="new badge ml-0 mr-2 pink lighten-1 rating-badge" data-badge-caption="">

                                                    <i class="material-icons white-text"> star </i> <span class="rating_value">{{$averageRating}}</span>
                                                </span>
                                                <p>Availability: <span class="green-text">Available</span></p>
                                                <p class="pink-text">Free Shipping</p>
                                                <div class="border-separator"></div>
                                                <ul class="list-bullet">
                                                    <li class="list-item-bullet">{{$product->sku}}</li>
                                                    <li class="list-item-bullet">{!! $product->description !!}</li>
                                                </ul>
                                                <h5>
                                                    @include('product._product_price')
                                                </h5>
                                                <input type="hidden" value="{{$product->sku}}" name="sku">
                                                <a href="{{route('productdetails',$product->sku)}}" class="waves-effect waves-light btn green mt-2">View Details</a>
                                                <a href="javascript:void(0);" id="wishList" data-productSku={{$product->sku}} class="waves-effect waves-light btn green mt-2 wishlist-trigger">
                                                    <i class="material-icons mr-3">favorite_border</i> Add to Wishlist
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat ">
                                            <i class="material-icons mr-3">close</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @else
                <div class="card-alert card cyan">
                    <div class="card-content white-text">
                        <p>INFO : No products available.</p>
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>



@endsection
@push('js')
    <script>
        // $('input[name=fresh_input]').change(function() {
        //     var value =  $('input[name=fresh_input]').val();
        //     var product_sku= $('input[name=product_sku]').val();
        //     $.ajax({
        //     url: "{{route('fresh.order.calculate')}}",
        //     type: "POST",
        //     data: {"value": value, "product_sku": product_sku , "_token": "{{ csrf_token() }}"},
        //     success: function (data) {
        //         $('.item_total_qty').html(value);
        //         $('.item_total_price').html(data.total_price);
        //         $('input[name=quantity]').val(value);
        //         $('input[name=unit_price]').val(data.unit_price);
        //         $('.total-price-block').show();
        //         $('.addToCart').attr('disabled', false);
        //     }
        // });
        // });

        // $(".trigger_minus").click(function(){
        //     if ($(this).next().val() > 0) {
        //         //if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
        //         if ($(this).next().val() > 0) {
        //             var updatedVal = $(this).next().val(+$(this).next().val() - 1);
        //         }

        //         var value =  $('input[name=fresh_input]').val();
        //         var product_sku= $('input[name=product_sku]').val();
        //         $.ajax({
        //             url: "{{route('fresh.order.calculate')}}",
        //             type: "POST",
        //             data: {"value": value, "product_sku": product_sku , "_token": "{{ csrf_token() }}"},
        //             success: function (data) {
        //                 $('.item_total_qty').html(value);
        //                 $('.item_total_price').html(data.total_price);
        //                 $('input[name=quantity]').val(value);
        //                 $('input[name=unit_price]').val(data.unit_price);
        //                 $('.total-price-block').show();
        //                 $('.addToCart').attr('disabled', false);
        //             }
        //         });
        //     }
        //     /*
        //     if($(this).next().val() == 0) {
        //         $('.addToCart').attr('disabled', true);
        //     }
        //     */
        // });

        // $(".trigger_plus").click(function(){
        //     //$(this).prev().val(+$(this).prev().val() + 1);
        //     var updatedVal = $(this).prev().val(+$(this).prev().val() + 1);
        //     //console.log(updatedVal);

        //     var value =  $('input[name=fresh_input]').val();
        //     var product_sku= $('input[name=product_sku]').val();
        //     $.ajax({
        //         url: "{{route('fresh.order.calculate')}}",
        //         type: "POST",
        //         data: {"value": value, "product_sku": product_sku , "_token": "{{ csrf_token() }}"},
        //         success: function (data) {
        //             $('.item_total_qty').html(value);
        //             $('.item_total_price').html(data.total_price);
        //             $('input[name=quantity]').val(value);
        //             $('input[name=unit_price]').val(data.unit_price);
        //             $('.total-price-block').show();
        //             $('.addToCart').attr('disabled', false);
        //         }
        //     });
        // });



        $(document).on('input', 'table .combat' , function() {
            $(".price-calculation-notification").show();
            var checkReadyStock=$(this).closest('table').hasClass("ready-stock-table-block");
            if(checkReadyStock){
                var inputValue = $(this).closest('td').find(".combat").val();
                var avlValue = $(this).closest('td').find(".avl").text();
                if(Number(avlValue) < Number(inputValue)){
                    $(this).closest('td').find(".combat").addClass('warning');
                    $(this).closest('td').find(".avl").css('color','red');
                    $('.total-price-block').hide();
                    $('.addToCart').attr('disabled', true);
                    $('.addToCart').hide();
                    $('.price-calculation').attr('disabled', true);
                    if($('.update-price-btn').not(':disabled')){
                        $('.update-price-btn').attr('disabled', true);
                    }
                    return false;
                }
                else{
                    $('.price-calculation').attr('disabled', false);
                    if($('.update-price-btn').is(':disabled')){
                        $('.update-price-btn').attr('disabled', false);
                    }
                    $(this).closest('td').find(".combat").removeClass('warning');
                    $(this).closest('td').find(".avl").css('color','rgba(0,0,0,0.87)');
                }
                var error=$('.ready-stock-table-block td input').hasClass("warning")
                if(error == true){
                    alert('Please check availability with quantity');
                    $('.total-price-block').hide();
                    $('.addToCart').attr('disabled', true);
                    $('.addToCart').hide();
                    $('.price-calculation').attr('disabled', true);
                    if($('.update-price-btn').not(':disabled')){
                        $('.update-price-btn').attr('disabled', true);
                    }

                }
            }

        })

        $(document).on('click', '.price-calculation' , function() {
            var tot = 0; // variable to sore sum
            var price= $('.ready_stock_price').text();
            var product_sku= $('input[name=product_sku]').val();

            $('.cusotmize-color-size-attr-tbody tr').each(function(){
                var inputs = $(this).find('input').not(':first');
                inputs.each(function(){
                    tot+=Number($(this).val()) || 0; // parse and add value, if NaN then add 0
                });
            });
            // $('table .combat').each(function() { // iterate over inputs except last
            //     tot += Number($(this).val()) || 0; // parse and add value, if NaN then add 0
            //
            // });
            $.ajax({
                url: "{{route('fresh.order.calculate')}}",
                type: "POST",
                data: {"value": tot, "product_sku": product_sku , "_token": "{{ csrf_token() }}",},
                beforeSend: function(){
				    $('.loading-message').html("Calculating the price.");
				    $('#loadingProgressContainer').show();
			    },
                success: function (data) {
                    console.log(data);
                    $('.loading-message').html("");
				    $('#loadingProgressContainer').hide();
                    $('.item_total_qty').html(tot);
                    $('.item_unit_price').html(data.unit_price);
                    $('.item_total_price').html(data.total_price);
                    $('input[name=quantity]').val(tot);
                    $('input[name=unit_price]').val(data.unit_price);
                    $('input[name=total_price]').val(data.total_price);
                    $('.total-price-block').show();
                    // if(data.total_price== 'out of range'|| data.total_price=='you must add Mimium order' ){
                    //    $('.addToCart').attr('disabled', true);
                    //    $('.update-price-btn').attr('disabled', true);
                    // }
                   if(data.flag==0){
                       $('.addToCart').attr('disabled', true);
                       $('.update-price-btn').attr('disabled', true);
                       $('.askForPrice').hide();
                    }
                    else if(data.flag==1){
                        $('.update-price-btn').attr('disabled', false);
                        $('.addToCart').hide();
                        $('.askForPrice').show();

                    }
                    else{
                       $('.addToCart').attr('disabled', false);
                       $('.update-price-btn').attr('disabled', false);
                       $('.addToCart').show();
                       $('.askForPrice').hide();
                    }


                    /*
                    if(data.total_price== 'out of range'){
                       $('.update-price-btn').attr('disabled', true);
                    }
                    else{
                       $('.update-price-btn').attr('disabled', false);
                    }
                    */
                }
            });
        });
        //product modification
        function addProdModReqContent()
        {
            var html= '<div class="row"><div class="input-field col s12"><textarea class="materialize-textarea product-modification-message" name="prod_mod_req[details][]"></textarea><label for="product-modification-message" class="">Type your modification request.</label></div><div class="input-field col s12"><label for="product-modification-image" class="product-modification-image">Upload Image</label><input type="file" name="prod_mod_req[image][]"></div><a href="javascript:void(0);" class="btn waves-effect waves-light red remove-prod-mod-req-content" onclick="removeProdModReqContent(this)"><i class="material-icons dp48">remove</i></a></div>';
            $(".prod-mod-req-content").append(html);
        }
        function removeProdModReqContent(el)
        {
            $(el).parent().remove();
        }
        //submit request
        $('#prodModReqForm').on('submit',function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var url = '{{ route("prod.mod.req.store") }}';
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: 'multipart/form-data',
                url: url,
                success:function(data)
                    {
                        // toastr.success(data.msg);
                        swal(data.message, data.success,data.type);
                        $('#prodModReqForm')[0].reset();
                        $("#product-modification-modal").modal('close');

                    },
                error: function(xhr, status, error)
                    {
                        $('#pmr-errors').empty();
                        $("#pmr-errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+error+"</div>")
                        $.each(xhr.responseJSON.error, function (key, item)
                        {
                            $("#pmr-errors").append("<div class='card-alert card red'><div class='card-content white-text card-with-no-padding'>"+item+"</div>")
                        });
                    }
            });
        });
    </script>
@endpush



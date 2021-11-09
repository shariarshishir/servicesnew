@if(count($products)>0)
    <div class="row active_grid">
        @foreach($products as $key=>$product)
            <div class="col s12 m4 l4">
                <div class="card">
                    <div class="card-content">
                        <div class="product_img">
                            <!--a href="javascript:void();" class="overlay_hover"></a-->
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
                                    <a href="#product-details-modal_{{$product->sku}}" class="btn waves-effect waves-light green lighten-1 product-more-details modal-trigger">
                                        <i class="material-icons dp48">remove_red_eye</i>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="product_short_details">
                            <!--a class="waves-effect waves-light btn modal-trigger" href="#modal3">View</a-->
                            <div class="product-title">
                                <a href="{{route('productdetails',$product->sku)}}">
                                    {{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}
                                </a>
                            </div>
                            <div class="product_price">
                                @include('product._product_price')

                                @if($product->availability==0 && ($product->product_type==2 || $product->product_type==3))
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
                                <a href="{{ route('users.myshop',$product->vendor->vendor_uid) }}">{{$product->vendor->vendor_name}}</a>
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
                                        <!--button id="add_to_cart" data-id="{{$product->sku}}"class="btn btn-success" onclick="addToCart('{{$product->sku}}')">ADD TO CART</button-->
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
    <div class="pagination-block-wrapper">
        <div class="col s12 center">
            {!! $products->links() !!}
        </div>
    </div>
@else
    <div class="card-alert card cyan">
        <div class="card-content white-text">
            <p>INFO : No products available.</p>
        </div>
    </div>
@endif

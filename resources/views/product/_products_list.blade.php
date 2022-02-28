
@if(count($products)>0)
    <div class="active_grid row ">
        @foreach($products as $key=>$product)
            <div class="col s12 m4">
                <div class="productBox">
                    <div class="favorite">
                        @if(in_array($product->id,$wishListShopProductsIds))
                            <a href="javascript:void(0);" onclick="addToWishList('{{$product->flag}}', '{{$product->id}}', $(this));" class="product-add-wishlist active">
                                <i class="material-icons dp48">favorite</i>
                            </a>
                        @else
                            <a href="javascript:void(0);" onclick="addToWishList('{{$product->flag}}', '{{$product->id}}', $(this));" class="product-add-wishlist">
                                <i class="material-icons dp48">favorite</i>
                            </a>
                        @endif
                    </div>

                    @if($product->availability==0 && ($product->product_type==2 || $product->product_type==3))
                        <div class="sold-out">Sold Out</div>
                    @endif
                    
                    <div class="inner_productBox">
                        <div class="imgBox">
                            @foreach($product->images as $key=>$image)
                                @if($product->businessProfile()->exists())
                                    <a href="{{route('productdetails',$product->sku)}}">
                                        <img src="{{asset('storage/'.$image->image)}}" class="single-product-img" alt="" />
                                    </a>
                                @else
                                    <a href="javascript:void(0);">
                                        <img src="{{asset('storage/'.$image->image)}}" class="single-product-img" alt="" />
                                    </a>
                                @endif
                                @break
                            @endforeach
                        </div>

                        <div class="products_inner_textbox">
                            <a href="{{route('productdetails',$product->sku)}}">
                                <div class="priceBox row">
                                    <div class="col m5 s5 apperal">Apparel</div>
                                    <!--div class="price col m7 s7 right-align">$26.50 <span>/pc</span></div-->
                                    <div class="price col m7 s7 right-align">@include('product._product_price')</div>
                                </div>
                                <h4>
                                    @if($product->businessProfile()->exists())
                                        {{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}
                                    @else
                                        {{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}
                                    @endif
                                </h4>

                                @if(isset($list->moq))
                                    <div class="product_moq">MOQ: {{$list->moq}}</div>
                                @endif
                                @if(isset($list->lead_time))
                                    <div class="product_lead_time">Lead time: {{$list->lead_time}}</div>
                                @endif
                            </a>
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

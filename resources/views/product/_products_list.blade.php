
@if(count($products)>0)
    <div class="active_grid row ">
        @foreach($products as $key=>$product)
            <div class="col s6 m4">
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
                                    <div class="col s12 m12 l4 apperal">
                                        <a href="{{ route("supplier.profile",$product->businessProfile->alias) }}">
                                            {{$product->product_type == 3 ? 'Non-Clothing' : 'Apparel'}}
                                        </a>
                                    </div>
                                    <div class="col s12 m12 l8 price">@include('product._product_price')</div>
                                </div>
                                <h4><a href="{{route('productdetails',$product->sku)}}" > {{ \Illuminate\Support\Str::limit($product->name, 35, '...') }}</a></h4>

                                @if(isset($product->moq))
                                    <div class="product_moq">MOQ: {{$product->moq}} {{$product->product_unit}}</div>
                                @endif
                                @if($product->product_type == 1)
                                    <div class="product_lead_time">Lead time:
                                        {{getLeadTime($product)}}
                                        {{-- @php
                                            $count= count(json_decode($product->attribute));
                                            $count = $count-2;
                                        @endphp
                                        @foreach (json_decode($product->attribute) as $k => $v)
                                            @if($k == 0 && $v[2] == 'Negotiable')
                                               {{$v[3]}} days
                                            @endif
                                            @if($loop->last && $v[2] != 'Negotiable')
                                                {{ $v[3] }} days
                                            @endif
                                            @if($loop->last && $v[2] == 'Negotiable')
                                                @foreach (json_decode($product->attribute) as $k => $v)
                                                        @if($k == $count)
                                                            {{ $v[3]  }} days
                                                        @endif
                                                @endforeach
                                            @endif
                                        @endforeach --}}
                                    </div>
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
            {!! $products->appends(request()->query())->links() !!}
        </div>
    </div>
@else
    <div class="card-alert card cyan">
        <div class="card-content white-text">
            <p>INFO : No products available.</p>
        </div>
    </div>
@endif

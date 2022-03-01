@if(count($products)>0)
    <!-- <div class="mainContainer">
        <div class="container"></div>
    </div> -->

    <div class="product_wrapper">
        <h3>All Products</h3>
        <div class="low_moq_products_wrap product_boxwrap row"  id="low_moq_body">
            @foreach ($products  as $list )

                <div class="col s6 m4">
                    <div class="productBox">
                        <div class="favorite">
                            @if(in_array($list->id,$wishListShopProductsIds) || in_array($list->id,$wishListMfProductsIds))
                                <a href="javascript:void(0);" onclick="addToWishList('{{$list->flag}}', '{{$list->id}}', $(this));"  class="product-add-wishlist active">
                                    <i class="material-icons dp48">favorite</i>
                                </a>
                            @else
                                <a href="javascript:void(0);" onclick="addToWishList('{{$list->flag}}', '{{$list->id}}', $(this));" class="product-add-wishlist">
                                    <i class="material-icons dp48">favorite</i>
                                </a>
                            @endif
                        </div>
                        @php
                            if($list->flag == 'shop'){
                                $title=$list->name;
                                if($list->images()->exists()){
                                    $img= asset('storage').'/'.$list->images[0]->image;
                                }else{
                                    $img= asset('storage').'/'.'images/supplier.png';
                                }

                            }else{
                                $title=$list->title;
                                if($list->product_images()->exists()){
                                    $img= asset('storage').'/'.$list->product_images[0]->product_image;
                                }else{
                                    $img= asset('storage').'/'.'images/supplier.png';
                                }

                            }
                        @endphp

                        <div class="inner_productBox">
                            <div class="imgBox"><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}"><img src="{{$img}}"></a></div>
                            <div class="products_inner_textbox">
                                    <div class="priceBox row">
                                        <div class="col s12 m4 apperal">
                                            <a href="{{ route("supplier.profile",$list->businessProfile->alias) }}">
                                                @if($list->flag == 'mb')
                                                    {{ucfirst($list->category->name)}}
                                                @else
                                                    {{$list->product_type == 3 ? 'Non-Clothing' : 'Apparel'}}
                                                @endif
                                            </a>
                                        </div>
                                        <div class="price col s12 m8 right-align moq-value">
                                            @if($list->flag == 'mb') $ {{$list->price_per_unit}}/<span class="unit"> {{$list->qty_unit}} @endif </span>
                                            @if($list->flag == 'shop')
                                                @php
                                                    $count= count(json_decode($list->attribute));
                                                    $count = $count-2;
                                                @endphp
                                                @foreach (json_decode($list->attribute) as $k => $v)
                                                    @if($k == 0 && $v[2] == 'Negotiable')
                                                        <span class="price_negotiable">{{ 'Negotiable' }}</span>
                                                    @endif
                                                    @if($loop->last && $v[2] != 'Negotiable')
                                                    $ {{ $v[2] }} / {{$list->product_unit}}{{-- $ is the value for price unite --}}
                                                    @endif
                                                    @if($loop->last && $v[2] == 'Negotiable')
                                                        @foreach (json_decode($list->attribute) as $k => $v)
                                                                @if($k == $count)
                                                                $ {{ $v[2]  }} {{ 'Negotiable' }} {{-- $ is the value for price unite --}}
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <h4><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}" >{{$title}}</a></h4>
                                    @if(isset($list->moq))
                                        <div class="product_moq">MOQ: {{$list->moq}} {{$list->flag == 'mb' ? $list->qty_unit : $list->product_unit}}</div>
                                    @endif
                                    @if($list->flag == 'mb' && isset($list->lead_time))
                                        <div class="product_lead_time">Lead time:
                                            @php
                                                $pattern= '/[^0-9\-]/';
                                                $preg_replace= preg_replace($pattern, '', $list->lead_time);
                                            @endphp
                                        {{$preg_replace}} days</div>
                                    @else
                                        @if($list->product_type == 1)
                                            <div class="product_lead_time">Lead time:

                                                {{getLeadTime($list)}}
                                                {{-- @php
                                                $count= count(json_decode($list->attribute));
                                                $count = $count-2;
                                                @endphp
                                                @foreach (json_decode($list->attribute) as $k => $v)
                                                    @if($k == 0 && $v[2] == 'Negotiable')
                                                    {{$v[3]}}
                                                    @endif
                                                    @if($loop->last && $v[2] != 'Negotiable')
                                                        {{ $v[3] }}
                                                    @endif
                                                    @if($loop->last && $v[2] == 'Negotiable')
                                                        @foreach (json_decode($list->attribute) as $k => $v)
                                                                @if($k == $count)
                                                                    {{ $v[3]  }}
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach --}}
                                            </div>
                                        @endif
                                    @endif
                            </div>

                        </div>


                    </div>




                    <!-- <div class="inner_productBox">
                        <div class="imgBox"><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}"><img src="{{$img}}"></a></div>
                        <h4>{{$title}}</h4>
                        <div class="moqBox">MOQ: {{$list->moq}}</div>
                        <div class="moq_view_details">
                            <a class="moq_buss_name moq_left left" href="{{ route("supplier.profile",$list->businessProfile->alias) }}">{{$list->businessProfile->business_name}}</a>
                            <a class="moq_view moq_right right" href="{{ route("mix.product.details", [$list->flag, $list->id]) }}">View Details </a>
                        </div>
                    </div> -->

                </div>

            @endforeach

        </div>
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

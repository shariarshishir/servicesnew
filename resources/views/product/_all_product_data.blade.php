@if(count($products)>0)
    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <h3>All Products</h3>
                <div class="low_moq_products_wrap product_boxwrap row"  id="low_moq_body">
                    @foreach ($products  as $list )

                        <div class="col m3 productBox">
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
                                <div class="priceBox row">
                                    <div class="col s6 m6 apperal"><a href="{{ route("supplier.profile",$list->businessProfile->alias) }}">{{$list->businessProfile->business_name}}</a></div>
                                    <div class="price col s6 m6 right-align moq-value">MOQ: {{$list->moq}}</div>
                                </div>
                                <h4><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}">{{$title}}</a></h4>
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

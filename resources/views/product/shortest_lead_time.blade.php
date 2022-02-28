@extends('layouts.app_containerless')

@section('content')

    <div class="mainContainer">
        <div class="container">

            <div class="products_filter_wrapper">
                <div class="row">
                    <div class="col s12 m3 left-column">
                        <div class="products_filter_list">
                            <h3>Filter by</h3>
                            <form action="" method="get" id="product_filter_form">

                                <a class='btn_green btn_clear' href=""> Reset </a>
                            </form>
                        </div>
                    </div>
                    <div class="col s12 m9 content-column">
                        <div class="show-product-results-wrapper products_filter_search_wrap">
                            <div class="filter_search">
                                <form action="" method="get">
                                    <div class="filter_search_inputbox">
                                        <i class="material-icons">search</i>
                                        <input class="filter_search_input " type="text" name="product_name" placeholder="Type product name" value="">
                                        <input class="btn_green btn_search" type="submit" value="search" onclick="">
                                    </div>
                                </form>
                            </div>
                            <div class="show-product-results-inside-wrapper">
                                <div class="show-total-results">
                                    Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}} of  {{$products->total()}} results
                                </div>
                            </div>
                        </div>
                        <div class="prodcuts-list">
                            <div class="product_wrapper">
                                <div class="product_boxwrap row">
                                    <h3>Shortest Lead Time Products</h3>
                                    <div class="low_moq_products_wrap shortest_lead_product_wrap row">
                                        @foreach ($products as $product)
                                            <div class="col s6 m4">
                                                <div class="productBox">
                                                    <div class="favorite">
                                                        @if(in_array($product->id,$wishListShopProductsIds) || in_array($product->id,$wishListMfProductsIds))
                                                            <a href="javascript:void(0);" onclick="addToWishList('{{$product->flag}}', '{{$product->id}}', $(this));"  class="product-add-wishlist active">
                                                                <i class="material-icons dp48">favorite</i>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0);" onclick="addToWishList('{{$product->flag}}', '{{$product->id}}', $(this));" class="product-add-wishlist">
                                                                <i class="material-icons dp48">favorite</i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="inner_productBox">
                                                        <div class="imgBox">
                                                            @if($product->product_images()->exists())
                                                                <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}"><img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt=""></a>
                                                            @endif
                                                        </div>
                                                        <div class="products_inner_textbox">
                                                            <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">
                                                                <div class="priceBox row">
                                                                    <!-- <div class="col s12 m6 apperal"><a href="{{route('supplier.profile',$product->businessProfile->alias)}}">{{ $product->businessProfile->business_name }}</a></div> -->
                                                                    <div class="col s12 m6 apperal">{{ $product->businessProfile->business_name }}</div>
                                                                    <div class="price col s12 m6 right-align lead-time-value">lead time: {{$product->lead_time}}</div>
                                                                </div>
                                                                <h4>{{$product->title}}</h4>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            
        </div>
    </div>

@endsection

@push('js')
    <script>
    </script>
@endpush

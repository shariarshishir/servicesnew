@extends('layouts.app_containerless')

@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap row">
                    <h3>Shortest Lead Time Products</h3>
                    <div class="low_moq_products_wrap shortest_lead_product_wrap row">
                        @foreach ($products as $product)
                            <div class="col s12 m4 l3">
                                <div class="productBox">
                                    @if($product->product_images()->exists())
                                        <div class="imgBox">
                                            <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}"><img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt=""></a>
                                        </div>
                                    @endif
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
                                    <div class="priceBox row">
                                        <div class="col s6 m6 apperal"><a href="{{route('supplier.profile',$product->businessProfile->alias)}}">{{ $product->businessProfile->business_name }}</a></div>
                                        <div class="price col s6 m6 right-align lead-time-value">lead time: {{$product->lead_time}}</div>
                                    </div>
                                    <h4><a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">{{$product->title}}</a></h4>
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

@endsection

@push('js')
    <script>
    </script>
@endpush

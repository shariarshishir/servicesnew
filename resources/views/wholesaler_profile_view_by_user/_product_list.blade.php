@if($business_profile->wholesalerProducts()->exists())
<div class="active_grid">
    @foreach($business_profile->wholesalerProducts as $key=>$product)
        <div class="col s12 m4 l3">
            <div class="productBox">
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
                    <div class="col m5 s5 apperal">Apparel</div>
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
        </div>
    @endforeach
</div>
{{-- <div class="pagination-block-wrapper">
    <div class="col s12 center">
        {!! $products->links() !!}
    </div>
</div> --}}
@else
<div class="card-alert card cyan lighten-5">
    <div class="card-content cyan-text">
        <p>INFO : There is no product for <b>{{ucwords($business_profile->business_name)}}</p>
    </div>
</div>
@endif


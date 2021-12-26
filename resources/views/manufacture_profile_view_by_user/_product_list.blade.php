@if($business_profile->manufactureProducts()->exists())
<div class="active_grid">
    @foreach($business_profile->manufactureProducts as $key=>$product)
        <div class="col s12 m4 l3">
            <div class="productBox">
                <div class="imgBox">
                    @foreach($product->product_images as $key=>$image)
                        <img src="{{asset('storage/'.$image->product_image)}}" class="single-product-img" alt="" />
                        @break
                    @endforeach
                    {{-- <div class="favorite">
                        <a href="javascript:void(0);" id="favorite" data-productSku="{{$product->sku}}" class="product-add-wishlist">
                            <i class="material-icons dp48">favorite</i>
                        </a>
                    </div> --}}
                </div>
                <div class="priceBox row">

                </div>
                <h4>
                    <a href="{{route('mix.product.details', ['mb', $product->id])}}">
                        {{ \Illuminate\Support\Str::limit($product->title, 35, '...') }}
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


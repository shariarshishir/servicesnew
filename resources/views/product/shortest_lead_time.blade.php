@extends('layouts.app_containerless')

@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap row">
                    <h3>Shortest Lead Time Products</h3>
                    <div class="low_moq_products_wrap">
                        @foreach ($products as $product)
                            <div class="col m3 productBox">
                                <p>{{$product->title}}</p>
                                    @if($product->product_images()->exists())
                                        <div class="imgBox">
                                            <img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt="">
                                        </div>
                                    @endif
                                <p>lead time: {{$product->lead_time}}</p>
                                <a href="{{route('supplier.profile',$product->business_profile_id)}}">{{ $product->businessProfile->business_name }}</a>
                                <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
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

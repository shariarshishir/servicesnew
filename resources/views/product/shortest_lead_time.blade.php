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
                                @if($product->product_images()->exists())
                                    <div class="imgBox">
                                        <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}"><img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt=""></a>
                                    </div>
                                @endif
                                
                                <h4>{{$product->title}}</h4>
                                <span class="load_time_box">lead time: <span class="load_time"> {{$product->lead_time}} </span></span>
                                <div class="moq_view_details">
                                    <a class="moq_buss_name moq_left left" href="{{route('supplier.profile',$product->business_profile_id)}}">{{ $product->businessProfile->business_name }}</a>
                                    <a class="moq_view moq_right right" href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
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

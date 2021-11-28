@extends('layouts.app_containerless')

@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap">
                    <h3>Low Moq Products</h3>
                    <div class="low_moq_products_wrap row">
                        @foreach ($products as $product)
                            <div class="col m3 productBox">
                                
                                @if($product->flag == 'shop')
                                    <div class="imgBox">
                                        <img src="{{asset('storage/'.$product->images[0]['image'])}}" alt="">
                                    </div>
                                @elseif($product->flag == 'mb')
                                    @if($product->product_images()->exists())
                                        <div class="imgBox">
                                            <img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt="">
                                        </div>
                                    @endif
                                @endif
                                
                                <h4>{{$product->title ?? $product->name }}</h4>
                                <div class="moqBox">MOQ: {{$product->moq}}</div>

                                <div class="moq_view_details">
                                    @if($product->businessProfile()->exists())
                                        <a class="moq_buss_name moq_left left" href="{{route('supplier.profile',$product->business_profile_id)}}">{{ $product->businessProfile->business_name }}</a>
                                        <a class="moq_view moq_right right" href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
                                    @else
                                        <a class="moq_demo moq_left left" href="javascript:void(0);">merchantbay demo</a>
                                        <a class="moq_view moq_right right" href="javascript:void(0);">View details</a>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

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
                                <p>{{$product->title ?? $product->name }}</p>
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
                                <p>moq: {{$product->moq}}</p>

                                @if($product->businessProfile()->exists())
                                    <a href="{{route('supplier.profile',$product->business_profile_id)}}">{{ $product->businessProfile->business_name }}</a>
                                    <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
                                @else
                                    <a href="javascript:void(0);">merchantbay demo</a>
                                    <a href="javascript:void(0);">View details</a>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

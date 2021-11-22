@extends('layouts.app_containerless')

@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap row">
                    <h3>Low Moq Products</h3>
                    @foreach ($products as $product)
                        <div class="col m3">
                            <p>{{$product->title ?? $product->name }}</p>
                            @if($product->flag == 'shop')
                                <img src="{{asset('storage/'.$product->images[0]['image'])}}" alt="">
                            @elseif($product->flag == 'mb')
                                @if($product->product_images()->exists())
                                    <img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt="">
                                @endif
                            @endif
                            <p>moq: {{$product->moq}}</p>
                            @php $businss_profile_id= $product->business_profile_id ?? 1 ; @endphp
                            <a href="{{route('supplier.profile',$businss_profile_id)}}">{{ $product->businessProfile ? $product->businessProfile->business_name : 'merchantbay demo' }}</a>
                            <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection

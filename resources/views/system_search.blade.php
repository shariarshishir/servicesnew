
@extends('layouts.app_containerless')
@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap">
                    <h3>Search Results</h3>
            
                    @foreach($allItems as $key=>$item)
                    @if($item->flag=="shop")
                    <div class="product-item">
                        <a href="{{ route('mix.product.details', [$item->flag, $item->id]) }}" class="overlay_hover">&nbsp;</a>
                        <div class="product-img">
                            <img src="{{asset('storage').'/'.$item->images[0]->image}}">
                        </div>
                        <div class="product-short-intro">
                            <h4>name</h4>
                            <div class="details">
                                <p>MO  quoted_printable_decode</p>
                            </div>
                        </div>
                    </div>
                    @elseif($item->flag=="mb")
                    <div class="product-item">
                        <a href="{{ route('mix.product.details', [$item->flag, $item->id]) }}" class="overlay_hover">&nbsp;</a>
                        <div class="product-img">
                            <img src="{{asset('storage').'/'.$item->product_images[0]->product_image}}">
                        </div>
                        <div class="product-short-intro">
                            <h4>{{$item->title}}</h4>
                            <div class="details">
                                <p>MOQ: {{$item->title}}</p>
                            </div>
                        </div>
                    </div>
                    @elseif( $item->title && $item->slug )
                    <div class="blog-item">
                        <a href="{{route('blogs.details',$item->slug)}}" class="overlay_hover">&nbsp;</a>
                        <div class="blog-img">
                            <img src="{{ asset('storage/'.$item->feature_image) }}">
                        </div>                       
                        <div class="blog-short-intro">
                            <h4>{{$item->title}}</h4>
                            <div class="details">
                                <p>{!! \Illuminate\Support\Str::limit(strip_tags($item->details), 250, '(...)')  !!}</p>
                            </div>
                        </div>
                    </div>
                    @else
                    
                    <div class="business-profile-item">
                        <a href="{{route('supplier.profile', $item->id)}}" class="overlay_hover">&nbsp;</a>
                        <div class="business-profile-img">
                            <img src="{{ asset('storage/'.$item->feature_image) }}">
                        </div>
                        <div class="business-profile-short-intro">
                            <h4>{{$item->business_name}}</h4>
                            <div class="details">
                                <p>{{$item->industry_type}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>    
            </div>    
        </div>
    </div>
    
@endsection
@push('js')

@endpush




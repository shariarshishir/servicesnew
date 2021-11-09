@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col s12 shop-banner-wrapper">
        <div class="shop-banner-img">
            @if(auth()->user()->user_banner)
            <img src="{{asset('storage/'.auth()->user()->user_banner)}}" id="preview-banner-before-upload" class="responsive-img" alt="Profile Banner Image" />
            @else
            <img src="{{asset('images/frontendimages/shop_banner.png')}}" id="preview-banner-before-upload" class="responsive-img" alt="Profile Banner Image" />
            @endif
        </div>
        <div class="shop-name">
            <i class="material-icons dp48">store</i> {{ $vendor->vendor_name }}
        </div>
    </div>
</div>

<div id="myshop" class="row">

    @include('user.myshop.storemenu')
    <div class="col m12">
        <div class="card card-with-padding">
            @php
            if(count($vendorReviews) > 0) 
            {
                foreach($vendorReviews as $vendorReview) 
                {
            @endphp
            <div class="review-item">
                <div class="reviewed-by">
                    <div class="user-image">
                        <img src="{{asset('storage/'.$vendorReview->user->image)}}" class="responsive-img" width="50px" />
                    </div>
                    <div class="user-name">
                        <span>Reviewd By</span> {{ $vendorReview->user->name }}
                    </div>
                </div>
                <div class="review-info">
                    <div class="row">
                        <div class="col s12">
                            <label>Overall : </label>
                            <div class="star-rating" data-score="{{ $vendorReview->overall_rating }}"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>Communication : </label>
                            <div class="star-rating" data-score="{{ $vendorReview->communication_rating }}"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>On Time Delivery : </label>
                            <div class="star-rating" data-score="{{ $vendorReview->ontime_delivery_rating }}"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>Sample Support : </label>
                            <div class="star-rating" data-score="{{ $vendorReview->sample_support_rating }}"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>Product Quality : </label>
                            <div class="star-rating" data-score="{{ $vendorReview->product_quality_rating }}"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>Experience : </label>
                            {{ $vendorReview->experience }}
                        </div>
                    </div>
                </div>
            </div>
            @php
                }
            } else {
            @endphp
            <div class="card-alert card cyan">
                <div class="card-content white-text">
                    <p>INFO : Don't have any reviews</p>
                </div>
            </div>
            @php } @endphp
        </div>
    </div>

</div>

@endsection

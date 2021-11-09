
@extends('layouts.app_containerless')

@section('content')
    <div id="main">
        <div class="row">
            <div class="banner-outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col l3 m12 s12 shop-categories-wrap">
                            <div class="card card-with-padding">
                                <div class="card-content">
                                    <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{route('categories.product',$category['slug'])}}">
                                                {{$category['name']}}
                                                @if(!empty($category['children']))
                                                    <span><i class="material-icons dp48">chevron_right</i></span>
                                                @endif
                                            </a>
                                            @if(!empty($category['children']))
                                            <ul class="sub-level">
                                                @foreach($category['children'] as $childcategory)
                                                    <li>
                                                        <a href="{{route('subcategories.product',['category'=>$category['slug'],'subcategory'=>$childcategory['slug']])}}">
                                                            {{ $childcategory['name'] }}
                                                            @if(!empty($childcategory['children']))
                                                                <span><i class="material-icons dp48">chevron_right</i></span>
                                                            @endif
                                                        </a>
                                                        @if(!empty($childcategory['children']))
                                                        <ul class="sub-level">
                                                            @foreach($childcategory['children'] as $childcategory2)
                                                                <li>
                                                                    <a href="{{route('sub.subcategories.product',['category'=>$category['slug'],'subcategory'=>$childcategory['slug'],'subsubcategory'=>$childcategory2['slug']])}}">{{ $childcategory2['name'] }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col l9 m12 s12 banner-outer">
                            <div class="slider banner-slider">
                                <ul class="slides">
                                    <li>
                                        <img src="{{asset('storage/images/frontendimages/banner_img.png')}}" alt="" /> <!-- random image -->
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-key-features">
                                <div class="row">
                                    <div class="col l4 m12 s12">
                                        <div class="key-item green lighten-1">
                                            <a href="javascript:void(0);" class="overlay_hover"></a>
                                            <div class="key-icon">
                                                <i aria-hidden="true" class="fab fa-phoenix-framework"></i>
                                            </div>
                                            <div class="key-content">
                                                <h4>SHOP BY STORE</h4>
                                                <p>Search By Store</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l4 m12 s12">
                                        <div class="key-item green lighten-1">
                                            <a href="javascript:void(0);" class="overlay_hover"></a>
                                            <div class="key-icon">
                                                <i aria-hidden="true" class="fas fa-circle-notch"></i>
                                            </div>
                                            <div class="key-content">
                                                <h4>EASY RETURNS</h4>
                                                <p>Up to &amp; days</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col l4 m12 s12">
                                        <div class="key-item green lighten-1">
                                            <a href="javascript:void(0);" class="overlay_hover"></a>
                                            <div class="key-icon">
                                                <i aria-hidden="true" class="fas fa-wallet"></i>
                                            </div>
                                            <div class="key-content">
                                                <h4>PAYMENTS</h4>
                                                <p>Credit cards available</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col m12 content-column">

                            <div class="row static-block">
                                <div class="col l6 m12 s12">
                                    <div class="customized-product-content-block">
                                        <img src="{{asset('images/frontendimages/customaize_layout.png')}}" alt="" />
                                        <h4>Find Best Suppliers Designs</h4>
                                        <h3>Customized products</h3>
                                        <p>Partner with one of 60,000 experienced manufacturers with design & production capabilities and on-time delivery.</p>
                                        <a href="{{route('buydesignsproducts')}}" class="btn waves-effect waves-light green darken-1">Learn More</a>
                                    </div>
                                </div>
                                <div class="col l6 m12 s12">
                                    <div class="readytoship-product-content-block">
                                        <img src="{{asset('images/frontendimages/ready_to_ship_img.png')}}" alt="" />
                                        <h4>Find Best Quality Products</h4>
                                        <h3>Ready to ship products</h3>
                                        <p>Source from 15 million products that are ready to ship, and leave the facility within 15 days.</p>
                                        <a href="{{route('readystockproducts')}}" class="btn waves-effect waves-light green darken-1">Learn More</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row static-block rfq-home-block-wrapper">
                                <div class="col m12">
                                    <h3>Submit Your Request for Quotation and let<br /> Merchant Bay source the best Supplier for you.</h3>
                                    <div class="ontimeDescription">
                                        <div class="align-items-stretch d-flex">
                                            <div class="col l6 m12 s12">
                                                <div class="banner-image">
                                                    <span>
                                                        <a href="https://www.merchantbay.com/create-rfq"><img src="{{asset('images/frontendimages/rfq_img.png')}}" alt="banner-img"></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col l6 m12 s12">
                                                <div class="description p-50">
                                                    <h2 class="text-color-brand">Request For Quote...</h2>
                                                    <p>RFQ Helps TO DO Fast Sourcing And Buyer Can Send And Receive Query Through RFQ. Through Manage RFQ, Buyer Can Compare All The Queries From The Suppliers And Communicate With THe Suppliers.</p>
                                                    <a href="https://www.merchantbay.com/create-rfq" class="btn waves-effect waves-light green darken-1">CREATE REQUEST</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row static-block last-block">
                                <div class="col m12 service-block-wrapper">
                                    <div class="row align-items-stretch d-flex">
                                        <div class="col s12 m12 l3">
                                            <div class="card service-block">
                                                <center><img src="{{asset('images/frontendimages/trade_assurance_img.png')}}" alt="Trade Assurance"></center>
                                                <h3>Trade Assurance</h3>
                                                <h4>Order Protection</h4>
                                                <ul>
                                                    <li>On-time shipping</li>
                                                    <li>Quality protection</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l3">
                                            <div class="card service-block">
                                                <center><img src="{{asset('images/frontendimages/payment_img.png')}}" alt="Payment"></center>
                                                <h3>Payment</h3>
                                                <h4>Payment Solution</h4>
                                                <ul>
                                                    <li>Global online payment</li>
                                                    <li>Security compliance</li>
                                                    <li>provide online refund if goods is not</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l3">
                                            <div class="card service-block">
                                                <center><img src="{{asset('images/frontendimages/inspection_solution.png')}}" alt="Inspection solution"></center>
                                                <h3>Inspection solution</h3>
                                                <h4>Inspection</h4>
                                                <ul>
                                                    <li>Production monitoring</li>
                                                    <li>On-site factory check</li>
                                                    <li>Reduced risks in delays and product</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l3">
                                            <div class="card service-block">
                                                <center><img src="{{asset('images/frontendimages/ocean_air_shipping.png')}}" alt="Ocean and air shipping"></center>
                                                <h3>Ocean and air shipping</h3>
                                                <h4>Logistics Service</h4>
                                                <ul>
                                                    <li>Fast ocean and air shipping</li>
                                                    <li>Competitive prices</li>
                                                    <li>Online tracking</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


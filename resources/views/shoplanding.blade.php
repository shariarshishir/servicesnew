
@extends('layouts.app_containerless')

@section('title', 'Merchant Bay, Fashion Sourcing Solution, Tech Enabled B2B Platform')
@section('description', 'Merchant Bay, B2B platform, Communication channel for buyer and supplier, Digital Platform, Manage Orders, Post RFQ, Best Suppliers in Bangladesh, Bangladesh RMG Sourching')
@section('image', asset('images/frontendimages/merchantbay_logoX200.png'))
@section('keywords', 'Supply Chain, B2B Fashion, Transparency, BI Tool, Fashion Marketplace, B2B Marketplace, Bangladesh RMG, RMG Sourcing, RMG, Smart Tool, T&A, Suppliers, Buyers, QC, Global, Live Fashion Market, Wholesaler, Sourcing, Platform, Export, RFQ, Quotation, Tool, MB, Merchant, Digitisation, Digitization, Digital Fashion, 3D Fashion, Bulk Fabric, Bulk Design, Bangladesh Fashion, Connect Fashion, Spotlight, Ready Stock, 1000 Suppliers, Yarn, Fabric, Garments, SaaS, Apparel sourcing, Best Suppliers in Bangladesh')
@section('robots', 'index, nofollow')

@section('content')
    <section class="landing_page_wrapper" itemprop="mainContentOfPage">
        <!-- New Landing design start -->
        <div class="landing_intro_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="home_intro_left">
                            <h1 itemprop="headline">Find Your Next Apparel Manufacturing Partner</h1>
                            <p itemprop="text">Join the tech enabled fashion sourcing platform to connect <br/>
                                directly with fashion manufacturers and <br/>
                                wholesalers in BANGLADESH</p>
                            
                            <div class="banner_search">
                                @php
                                    $searchType= request()->get('search_type');
                                @endphp
                                <div class="module-search">
                                    <select id="searchOption" class="select2 browser-default select-search-type">
                                        <option value="all" name="search_key" {{ $searchType=="all" ? 'selected' : '' }}>All</option>
                                        <option value="product" name="search_key" {{ $searchType=="product" ? 'selected' : '' }}>Products</option>
                                        <option value="vendor"  name="search_key" {{ $searchType=="vendor" ? 'selected' : '' }}>Manufacturers</option>
                                    </select>
                                    <form name="system_search" action="{{route('onsubmit.search')}}" id="system_search" method="get">
                                        @if(Route::is('onsubmit.search'))
                                        <input type="text" placeholder="Example: Baby Sweaters, T-Shirts, Viscose, Radiant Sweaters etc." value="{{$searchInputValue}}" class="search_input"  name="search_input"/>
                                        @else
                                        <input type="text" placeholder="Example: Baby Sweaters, T-Shirts, Viscose, Radiant Sweaters etc." value="" class="search_input"  name="search_input"/>
                                        @endif
                                        <input type="hidden" name="search_type" class="search_type" value="" />
                                        <button class="btn waves-effect waves-light green darken-1 search-btn" type="submit" ><i class="material-icons dp48">search</i></button>
                                    </form>
                                    <div id="search-results-wrapper" style="display: none;">
                                        <div id="loadingSearchProgressContainer">
                                            <div id="loadingSearchProgressElement">
                                                <img src="{{asset('images/frontendimages/new_layout_images/loading-gray.gif')}}" width="128" height="15" alt="Loading">
                                                <div class="loading-message" style="display: none;">Loading...</div>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" class="close-search-modal-trigger"><i class="material-icons dp48">cancel</i></a>                    
                                        <div id="search-results" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="home_intro_right mobile_home_intro_img" style="display: none;">
                                <img itemprop="image" alt="" src="{{asset('images/frontendimages/new-home/home-intro.png')}}" />
                            </div>

                            <div class="landing_intro_button_box">
                                <a class="btn_howWrok btn_border_black" data-fancybox href="https://youtu.be/8z7uqq_Zqzg"><i class="material-icons"> play_circle_outline </i> How we work</a>
                                <a href="javascript:void(0);" class="btn_green btn_talk" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/merchantbay/virtual-meeting'});return false;">Talk to us <i class="material-icons"> east </i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 ">
                        <div class="home_intro_right">
                            <img itemprop="image" alt="" src="{{asset('images/frontendimages/new-home/home-intro.png')}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing_provide_wrap">
            <div class="container">
                <h2>Values we provide...</h2>
                <div class="row">
                    <div class="col s12 m12 l2">&nbsp;</div>
                    <div class="col s12 m6 l4">
                        <div class="provide_items_box provide_left">
                            <h3><span>For Buyers</span></h3>
                            <ul itemscope itemtype="https://schema.org/ListItem">
                                <li itemprop="itemListElement">Find Vetted Manufacturers</li>
                                <li itemprop="itemListElement">Find Manufacturers for Low MOQ</li>
                                <li itemprop="itemListElement">Source Textiles and Accessories</li>
                                <li itemprop="itemListElement">Source with Shortest Lead Time</li>
                                <li itemprop="itemListElement">Manage Orders with Transparency</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="provide_items_box">
                            <h3><span>For Suppliers</span></h3>
                            <ul itemscope itemtype="https://schema.org/ListItem">
                                <li itemprop="itemListElement">Create and Promote Your Digital Presence</li>
                                <li itemprop="itemListElement">Create Your Digital Product Library</li>
                                <li itemprop="itemListElement">Source Raw Materials at Best Deal</li>
                                <li itemprop="itemListElement">Be Data Driven with Smart Bi Tools</li>
                                <li itemprop="itemListElement">Manage Orders with Efficiency</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m12 l2">&nbsp;</div>
                </div>
                <div class="center-align provide_btn_wrap">
                    <a href="{{env('SSO_REGISTRATION_URL').'/?flag=global'}}" class="btn_green">Sign up</a>
                </div>
            </div>
        </div>

        <div class="landing_spotlight_wrap">
            <div class="landing_spotlight_top">
                <div class="container">
                    <div class="spotlight_box"><img itemprop="image" src="{{asset('images/frontendimages/new-home/Spotlight.png')}}" alt="" /></div>
                </div>
            </div>
            <div class="landing_spotlight_infoWrap">
                <div class="container-full-width">
                    @php 
                        $spotlightCount = 0;
                    @endphp
                    @foreach($spotlightBusinessProfile as $businessProfile)
                        <div id="spotlight-{{$spotlightCount}}">
                            <div class="spotlight_overlay"></div>
                            <div class="spotlight-inside-image">
                                @if($businessProfile->business_profile_banner)
                                <img itemprop="image" src="{{ asset('storage/'.$businessProfile->business_profile_banner) }}" alt="" />
                                @else
                                <img itemprop="image" src="{{ asset('images/frontendimages/new-home/spot-li.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="container">
                                <div class="spotlight-inside">
                                    <div class="right-align sayel_group_logo_box">
                                        <!--img src="{{ asset('storage/'.$businessProfile->user->image) }}" alt="" /-->
                                        @if($businessProfile->business_profile_logo)
                                        <img itemprop="image" src="{{ asset('storage/'.$businessProfile->business_profile_logo) }}" alt="" />
                                        @else
                                            @php
                                                $img = $businessProfile->user->image ?'storage/'.$businessProfile->user->image : 'images/frontendimages/no-image.png';
                                            @endphp                                        
                                            <img itemprop="image" itemprop="image" src="{{asset($img)}}" alt="avatar" />
                                        @endif
                                    </div>
                                    <div class="spotlight_inner_info">
                                        <h3>{{ $businessProfile->business_name }}</h3>
                                        <div class="spotlight_info">{{ \Illuminate\Support\Str::limit($businessProfile->companyOverview->about_company, 550, $end='[...]') }}</div>
                                    </div>
                                    <div class="right-align">
                                        <a href="{{route('supplier.profile', $businessProfile->alias)}}" class="btn_green landing_view_profile" >View Profile</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        @php $spotlightCount++; @endphp 
                    @endforeach
                </div>
            </div>
        </div>

        <div class="landing_nav_wrap">
          <div class="container">
            <div class="landing_tab_menu">
                <ul class="spotlight_tabs">
                    @php 
                        $spotlightCount = 0;
                    @endphp
                    @foreach($spotlightBusinessProfile as $businessProfile)
                        <li class="tab"><a href="#spotlight-{{$spotlightCount}}">{{ $businessProfile->business_name }}</a></li>
                        @php $spotlightCount++; @endphp 
                    @endforeach
                </ul>
            </div>
          </div>
        </div>

        <div class="mvc_produce_design_wrap">
          <div class="container">
            <div class="row"> 
                <div class="col s12 m6 product_video_wrap">
                    <div class="product_video_box">
                        <img itemprop="image" src="{{asset('images/frontendimages/new-home/360-white.GIF')}}" alt="Animated Image" />
                    </div>
                </div>
                <div class="col s12 m6 product_video_infobox">
                    <div class="product_3d_info_box">
                        <h1><span>Develop your product<br />with <span style="font-weight: 600;">MB Studio</span></span></h1>
                        <p>Our 3D design service helps you to reduce lead time<br />significantly. We have a huge library of 1000+ designs<br />ranging from outerwear to underwear. Our product<br />development team brings the design to life as best<br />valued products with our technical expertise and<br />wide sourcing network.</p>
                    </div>

                    <div class="visit_studio">
                        <a href="{{route('buydesignsproducts')}}" class="btn_green btn_visit_studio" >Visit Studio</a>
                    </div>
                </div>
              
            </div>
          </div>
        </div>

        <div class="landing_sourcing_wrap">
          <div class="container">
            <div class="row">
              <div class="col s12 m6">
                <div class="sourcing_info_box">
                    <h1><span> Bring the <span style="font-weight: 600;">Sourcing</span> <br/>
                    to your <span style="font-weight: 600;">Pocket</span></h1>
                    <p>Everything you need for your Apparel Business.</p>
                    <p><span style="font-weight: 600;">Yarn, Fabrics, Trims, Accessories, Garments </span> <br/> and many more....</p>
                </div>
                <div class="sourcing_img_box mobile_sourcing_img_box" style="display: none;">
                    <img alt="" src="{{asset('images/frontendimages/new-home/sourcing-img.jpg')}}" />
                </div>
                <div class="sourcing_apps_box">
                    <h3>Download the App</h3>
                    <div class="apps_wrap">
                        <a href="https://apps.apple.com/dk/app/merchant-bay/id1590720968?l=en"><img src="{{asset('images/frontendimages/new-home/app-store.png')}}" alt="" /> </a>
                        <a href="https://play.google.com/store/apps/details?id=com.sayemgroup.merchantbay"><img src="{{asset('images/frontendimages/new-home/google-play.png')}}" alt="" /> </a>
                    </div>
                </div>
              </div>
              <div class="col s12 m6">
                    <div class="sourcing_img_box">
                        <img alt="" src="{{asset('images/frontendimages/new-home/sourcing-img.png')}}" />
                    </div>
              </div>
            </div>
          </div>
        </div>

        <div class="landing_tools_wrap">
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 landing_tools_left">
                        <div class="landing_tools_img">
                            <img src="{{asset('images/frontendimages/new-home/tools-img.png')}}" alt="" />
                        </div>
                    </div>
                    <div class="col s12 m6 landing_tools_right">
                        <div class="landing_tools_infobox">
                            <h1>Increase your <span style="font-weight: 600;">Efficiency</span> <br/> with <span style="font-weight: 600;">Smart BI Tools</span></h1>
                            <p>Subscribe to the Smart Order Management Dashboard and a suit of BI tools offered by Merchant Bay to make your operation data driven and transparent.</p>
                            <div class="tools_button_box">
                                <a href="https://tools.merchantbay.com/" class="btn_border_black" target="_blank" >Explore MB Smart Tools</a>
                                <!-- <button class="btn_green request_demo">Request a Demo</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing_request_wrap">
            <div class="container">
                <div class="request_innter_box center-align">
                    <h1>Want to start real quick?</h1>
                    <h5>Submit a request for quotation enjoy sourcing <br/> from Bangladesh like never before</h5>
                    <div class="landing_request_img">
                        <img src="{{asset('images/frontendimages/new-home/landing-rfq.png')}}" alt="" />
                    </div>
                    <div class="request_button_box center-align">
                        <a href="{{route('rfq.index')}}" class="btn_border_black">Submit RFQ</a>
                        <a href="javascript:void(0);" class="btn_green btn_talk" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/merchantbay/virtual-meeting'});return false;">Talk to us <i class="material-icons"> east </i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Landing design end -->
    </section>

@endsection
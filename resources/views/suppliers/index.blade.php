@extends('layouts.app')

@section('content')
@include('sweet::alert')
@php
    $business_type = array_key_exists('business_type', app('request')->input())?app('request')->input('business_type'):[];
    // $industry_type = array_key_exists('industry_type', app('request')->input())?app('request')->input('industry_type'):[];
    $factory_type = array_key_exists('factory_type', app('request')->input())?app('request')->input('factory_type'):[];
    $location = array_key_exists('location', app('request')->input())?app('request')->input('location'): '';
    $business_name = array_key_exists('business_name', app('request')->input())?app('request')->input('business_name'): '';
    $standard = array_key_exists('standard', app('request')->input())?app('request')->input('standard'): [];
    $verified = array_key_exists('verified', app('request')->input())?app('request')->input('verified'): [];

    // $factory_type_array=[
    //     '2002'=>'woven',
    //     '2004'=>'knit',
    //     '2005'=>'sweater',
    //     '2006'=>'accessories',
    //     '2008'=>'denim',
    //     '2009'=>'lingerie',
    //     '2011'=>'textile',
    //     '2012'=>'yarn & spinning',
    //     '2033'=>'others',
    //     ];
@endphp

    <div class="suppliers_container suppliers_filter_wrapper row" itemscope>
        <div class="col s12 m4 l3" itemscope>
            <div class="suppliers_filter_list" itemscope itemtype="https://schema.org/WebSite">
                <h3 itemprop="title">Filter by</h3>

                <link itemprop="url" href="http://www.example.com/"/>
                <form action="{{route('suppliers')}}" method="get" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
                    <meta itemprop="target" content="http://example.com/search?q={location}"/>

                    {{--location search  --}}
                    <div class="filter_search" itemscope itemtype="https://schema.org/SearchAction">
                        <h4 itemprop="address">Location</h4>
                        <div itemprop="address" class="filter_search_inputbox" itemscope>
                            <i class="material-icons">pin_drop</i>
                            <input itemprop="query" class="filter_search_input" type="text" name="location" placeholder="Type any location" value="{{$location}}">
                        </div>
                        <!-- <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();"> -->
                    </div>
                    {{-- business_type --}}
                    <div class="filter_box" itemscope itemtype="https://schema.org/manufacturer" >
                        <h4 itemprop="title">Business Type</h4>
                        @foreach ($industry_type_cat as $item)
                            <p>
                                <label itemprop="name">
                                <input class="btn_radio" type="checkbox" value="{{$item->name}}" name="business_type[]" {{ (in_array($item->name, $business_type))?'checked':'' }} onclick="this.form.submit();"/>
                                    <span>{{ucwords($item->name)}}</span>
                                </label>
                            </p>
                        @endforeach
                    </div>
                    {{-- factory type --}}
                    <div class="filter_box" itemscope itemtype="https://schema.org/industry">
                        <h4 itemprop="title">Factory Type</h4>
                        @foreach ($factory_type_cat as $list)
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="{{$list}}"  name="factory_type[]" {{ (in_array($list, $factory_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>{{ucwords($list)}}</span>
                            </label>
                        </p>
                        @endforeach
                    </div>

                    {{-- standard --}}
                    <div class="filter_box" itemscope style="display: none;">
                        <h4 itemprop="title">Standard</h4>
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="compliance"  name="standard[]" {{ (in_array('compliance', $standard))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Compliance</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="non_compliance"  name="standard[]" {{ (in_array('non_compliance', $standard))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Non-Compliance</span>
                            </label>
                        </p>
                    </div>

                    {{-- standard --}}
                    <div class="filter_box" itemscope style="display: none;">
                        <h4 temprop="title">Badge</h4>
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="1"  name="verified[]" {{ (in_array('1', $verified))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Verified</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="0"  name="verified[]" {{ (in_array('0', $verified))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Unverified</span>
                            </label>
                        </p>
                    </div>
                    <a class='btn_green btn_clear' href="{{route('suppliers')}}"> Reset </a>
                </form>
            </div>

        </div>
        <div class="col s12 m8 l9" itemscope>
            <div class="suppliers_filter_content" itemscope>
                {{-- business name search --}}
                <div class="filter_search row" itemscope>
                    <div class="col s12" itemscope itemtype="https://schema.org/WebSite">

                        <link itemprop="url" href="http://www.example.com/"/>

                        <form action="{{route('suppliers')}}" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">

                            <meta itemprop="target" content="http://example.com/search?q={business_name}"/>

                            <div class="filter_search_inputbox" itemscope>
                                <i class="material-icons">search</i>
                                <input itemprop="business_name" itemprop="query" class="filter_search_input " type="text" name="business_name" placeholder="business name" value="{{$business_name_from_home ?? $business_name}}">
                                <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();">
                            </div>
                        </form>
                    </div>
                </div>

                @if(count($suppliers)>0)
                    @foreach ($suppliers as $supplier)
                        @php
                            $mainProductsJson = json_decode($supplier->companyOverview['data']);
                        @endphp
                        <div class="industry_infoBox" itemscope itemtype="https://schema.org/Organization">
                            <div class="industry_info_inner_box" itemscope>
                                <div class="row" itemscope>
                                    <div class="supplier_profile_image_block col s12 m12 l3" itemscope itemtype="https://schema.org/manufacturer">
                                        @if($supplier->business_profile_logo)
                                        <img itemprop="logo" src="{{ Storage::disk('s3')->url('public/'.$supplier->business_profile_logo) }}" alt="avatar" >
                                        @else
                                        @php
                                            $img=$supplier->user->image ?Storage::disk('s3')->url('public/'.$supplier->user->image) : 'images/frontendimages/no-image.png';
                                        @endphp
                                        <img itemprop="image" src="{{asset($img)}}" alt="avatar" >
                                        @endif

                                        @if(Auth::guard('web')->check())
                                            <a itemprop="profile" href="{{route('supplier.profile', $supplier->alias)}}">Visit Profile</a>
                                        @else
                                            <a itemprop="profile" href="#supplier-view-auth-check-modal" class="modal-trigger">Visit Profile</a>
                                        @endif
                                    </div>
                                    <div class="supplier_profile_short_info_block col s12 m12 l9" itemscope itemtype="https://schema.org/manufacturer" >
                                        <h5 itemprop="name">{{$supplier->business_name}}</h5>
                                        <div class="industry_location short_info_box" itemscope itemtype="https://schema.org/location">
                                            <span class="title_label">Location:</span>
                                            <span itemprop="address" class="info_details">{{$supplier->location}}</span>
                                        </div>
                                        <div class="industry_type short_info_box" itemscope itemtype="https://schema.org/industry">
                                            <span class="title_label">Industry Type: </span>
                                            <span itemprop="name" class="info_details">{{$supplier->industry_type}}</span>
                                        </div>
                                        <div class="factory_type short_info_box" itemscope itemtype="https://schema.org/category">
                                            <span class="title_label">Factory Type:</span>
                                            <span itemprop="name" class="businessCategory info_details">{{$supplier->factory_type ?? ''}}</span>
                                        </div>
                                        @foreach($mainProductsJson as $mainProducts)
                                            @if($mainProducts->name == 'main_products')
                                            <div class="main_products short_info_box" itemscope itemtype="https://schema.org/Product">
                                                <span class="title_label" itemprop="name">Main Products:</span>
                                                <span itemprop="value" class="info_details">{{$mainProducts->value}}</span>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        {{$suppliers->appends(request()->query())->links()}}
                    </div>
                @else
                    <div class="card-alert card cyan">
                        <div class="card-content white-text">
                            <p>INFO : No data found.</p>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>

    <div id="supplier-view-auth-check-modal" class="modal verification-message-modal">
        <div class="modal-content">

            <div class="row">
                <div class="col s12 m12 l12 ">
                    <div class="supplier_view_right center-align">
                        <span class="material-icons" style="font-size: 45px;margin-bottom: 20px;">message</span>
                        <h5>Become a verified buyer to view supplier profiles</h5>
                        <a class="btn_green" href="{{route('login')}}">sign in</a>
                        <a class="btn_green" href="{{env('SSO_REGISTRATION_URL').'/?flag=global'}}" > sign up</a>
                    </div>
                </div>
            </div>


            <!-- <p>Become a verified buyer to view company profile</p>
            <a href="{{route('login')}}">sign in</a>
            <a href="{{env('SSO_REGISTRATION_URL').'/?flag=global'}}" > sign up</a> -->
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
@endsection

@include('suppliers._scripts')

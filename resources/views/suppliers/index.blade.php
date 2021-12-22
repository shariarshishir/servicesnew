@extends('layouts.app')

@section('content')
@include('sweet::alert')
@php
    $industry_type = array_key_exists('industry_type', app('request')->input())?app('request')->input('industry_type'):[];
    $factory_type = array_key_exists('factory_type', app('request')->input())?app('request')->input('factory_type'):[];
    $location = array_key_exists('location', app('request')->input())?app('request')->input('location'): '';
    $business_name = array_key_exists('business_name', app('request')->input())?app('request')->input('business_name'): '';
    $standard = array_key_exists('standard', app('request')->input())?app('request')->input('standard'): [];
    $verified = array_key_exists('verified', app('request')->input())?app('request')->input('verified'): [];

    $factory_type_array=[
        '2'=>'woven',
        '4'=>'knit',
        '5'=>'sweater',
        '6'=>'accessories',
        '8'=>'denim',
        '9'=>'lingerie',
        '11'=>'textile',
        '12'=>'yarn & spinning',
        '33'=>'others',
        ];
@endphp

    <div class="suppliers_container suppliers_filter_wrapper row">
        <div class="col s12 m4 l3">
            <div class="suppliers_filter_list">
                <h3>Filter by</h3>
                <form action="{{route('suppliers')}}" method="get">
                    {{--location search  --}}
                    <div class="filter_search">
                        <h4>Location</h4>
                        <div class="filter_search_inputbox">
                            <i class="material-icons">pin_drop</i>
                            <input class="filter_search_input typeahead" type="text" name="location" placeholder="Type any location" value="{{$location}}">
                        </div>

                        <!-- <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();"> -->
                    </div>
                    {{-- industry_type --}}
                    <div class="filter_box">
                        <h4>Industry Type</h4>
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="apparel"  name="industry_type[]" {{ (in_array('apparel', $industry_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Apparel</span>
                            </label>
                        </p>
                        <p>
                            <label>
                            <input class="btn_radio" type="checkbox" value="non-apparel" name="industry_type[]" {{ (in_array('non-apparel', $industry_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Non-Apparel</span>
                            </label>
                        </p>
                    </div>
                    {{-- factory type --}}
                    <div class="filter_box">
                        <h4>Factory Type</h4>
                        @foreach ($factory_type_array as $key => $list)
                        <p>
                            <label>
                                <input class="btn_radio" type="checkbox" value="{{$key}}"  name="factory_type[]" {{ (in_array($key, $factory_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>{{ucwords($list)}}</span>
                            </label>
                        </p>
                        @endforeach
                    </div>

                    {{-- standard --}}
                    <div class="filter_box">
                        <h4>Standard</h4>
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
                    <div class="filter_box">
                        <h4>Badge</h4>
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
        <div class="col s12 m8 l9">
            <div class="suppliers_filter_content">
                {{-- business name search --}}
                <div class="filter_search row">
                    <div class="col s12">
                        <form action="{{route('suppliers')}}" method="get">
                            <div class="filter_search_inputbox">
                                <i class="material-icons">search</i>
                                <input class="filter_search_input " type="text" name="business_name" placeholder="business name" value="{{$business_name_from_home ?? $business_name}}">
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
                        <div class="industry_infoBox">
                            <div class="industry_info_inner_box">
                                <div class="row">
                                    <div class="supplier_profile_image_block col s12 m12 l3">
                                        @if($supplier->user->image)
                                        <img src="{{ asset('storage/'.$supplier->user->image) }}" alt="">
                                        @else
                                        <img src="{{asset('images/frontendimages/no-image.png')}}" alt="avatar">
                                        @endif

                                        @if(Auth::guard('web')->check())
                                            <a href="{{route('supplier.profile', $supplier->id)}}">Visit Profile</a>
                                        @else
                                            <a href="#supplier-view-auth-check-modal" class="modal-trigger">Visit Profile</button>
                                        @endif
                                    </div>
                                    <div class="supplier_profile_short_info_block col s12 m12 l9">
                                        <h5>{{$supplier->business_name}}</h5>
                                        <div class="industry_location short_info_box"><span class="title_label">Location:</span> <span class="info_details">{{$supplier->location}}</span></div>
                                        <div class="industry_type short_info_box"><span class="title_label">Industry Type: </span> <span class="info_details">{{$supplier->industry_type}}</span></div>
                                        <div class="factory_type short_info_box"><span class="title_label">Factory Type:</span> <span class="info_details">{{$supplier->businessCategory ? $supplier->businessCategory->name : ''}}</span></div>
                                        @foreach($mainProductsJson as $mainProducts)
                                            @if($mainProducts->name == 'main_products')
                                            <div class="main_products short_info_box"><span class="title_label">Main Products:</span> <span class="info_details">{{$mainProducts->value}}</span></div>
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

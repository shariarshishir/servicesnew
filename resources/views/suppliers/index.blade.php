@extends('layouts.app')

@section('content')
@include('sweet::alert')
@php
    $industry_type = array_key_exists('industry_type', app('request')->input())?app('request')->input('industry_type'):[];
    $factory_type = array_key_exists('factory_type', app('request')->input())?app('request')->input('factory_type'):[];
    $location = array_key_exists('location', app('request')->input())?app('request')->input('location'): '';
    $business_name = array_key_exists('business_name', app('request')->input())?app('request')->input('business_name'): '';
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

    <div class="suppliers_container row">
        <div class="col s12 m4 l3 suppliers_filter_list">
            <form action="{{route('suppliers')}}" method="get">
                {{--location search  --}}
                <div class="filter_search">
                    <i class="material-icons">search</i>
                    <input class="filter_search_input typeahead" type="text" name="location" placeholder="Type any location" value="{{$location}}">
                    <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();">
                </div>                
                {{-- industry_type --}}
                <div class="filter_box">
                    <legend>Industry Type</legend>
                    <p>
                        <label>
                            <input type="checkbox" value="apparel"  name="industry_type[]" {{ (in_array('apparel', $industry_type))?'checked':'' }} onclick="this.form.submit();"/>
                            <span>Apparel</span>
                        </label>
                    </p>
                    <p>
                        <label>
                        <input type="checkbox" value="non-apparel" name="industry_type[]" {{ (in_array('non-apparel', $industry_type))?'checked':'' }} onclick="this.form.submit();"/>
                            <span>Non-Apparel</span>
                        </label>
                    </p>
                </div>
                {{-- factory type --}}
                <div class="filter_box">
                    <legend>Factory Type</legend>
                    @foreach ($factory_type_array as $key => $list)
                    <p>
                        <label>
                            <input type="checkbox" value="{{$key}}"  name="factory_type[]" {{ (in_array($key, $factory_type))?'checked':'' }} onclick="this.form.submit();"/>
                            <span>{{ucwords($list)}}</span>
                        </label>
                    </p>
                    @endforeach
                </div>
                <a class='btn btn_green btn_clear' href="{{route('suppliers')}}"> Clear </a>
            </form>
        </div>
        <div class="col s12 m8 m9 suppliers_filter_content">
            {{-- business name search --}}
            <div class="filter_search">
                <form action="{{route('suppliers')}}" method="get">
                    <i class="material-icons">search</i>
                    <input class="filter_search_input" type="text" name="business_name" placeholder="business name" value="{{$business_name}}">
                    <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();">
                </form>
            </div> 
            @foreach ($suppliers as $supplier)
                @php
                    $mainProductsJson = json_decode($supplier->companyOverview['data']);
                @endphp
                <div class="industry_infoBox">
                    <div class="box_shadow">
                        <div class="row">
                            <div class="supplier_profile_image_block col m3">
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
                            <div class="supplier_profile_short_info_block col m9">
                                <h5>{{$supplier->business_name}}</h5>
                                <p class="industry_location">Location: {{$supplier->location}}</p>
                                <p class="industry_type">Industry Type: {{$supplier->industry_type}}</p>
                                <p class="factory_type">Factory Type: {{$supplier->businessCategory ? $supplier->businessCategory->name : ''}}</p>
                                @foreach($mainProductsJson as $mainProducts)
                                    @if($mainProducts->name == 'main_products')
                                    <p class="main_products">Main Products: {{$mainProducts->value}}</p>
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

        </div>
    </div>

    <div id="supplier-view-auth-check-modal" class="modal">
        <div class="modal-content">
            <p>Become a verified buyer to view company profile</p>
            <a href="{{route('login')}}">sign in</a>
            <a href="{{env('SSO_REGISTRATION_URL').'/?flag=global'}}" > sign up</a>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
@endsection

@include('suppliers._scripts')

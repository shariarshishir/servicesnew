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

    <div class="suppliers_container">
        <div class="filter suppliers_filter_wrap">
            <span class="filter_box_wrap">
                <form action="{{route('suppliers')}}" method="get">
                    {{-- industry_type --}}
                    <span class="filter_box">
                        <a class='dropdown-trigger btn btn_white filter_dropMenu' href='#' data-target='industry_type'>Industry Type
                        <i class="material-icons">arrow_drop_down</i> </a>
                        <ul id='industry_type' class='dropdown-content'>
                            <li><label>
                                <input type="checkbox" value="apparel"  name="industry_type[]" {{ (in_array('apparel', $industry_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Apparel</span>
                            </label>
                            </li>

                            <li><label>
                                <input type="checkbox" value="non-apparel" name="industry_type[]" {{ (in_array('non-apparel', $industry_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Non-Apparel</span>
                            </label>
                            </li>
                        </ul>
                    </span>
                    {{-- factory type --}}
                    <span class="filter_box">
                        <a class='dropdown-trigger btn btn_white filter_dropMenu' href='#' data-target='factory_type'>Factory Type
                        <i class="material-icons">arrow_drop_down</i> </a>
                        <ul id='factory_type' class='dropdown-content'>
                            @foreach ($factory_type_array as $key => $list)
                                <li>
                                    <label>
                                        <input type="checkbox" value="{{$key}}"  name="factory_type[]" {{ (in_array($key, $factory_type))?'checked':'' }} onclick="this.form.submit();"/>
                                        <span>{{ucwords($list)}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </span>
                    {{--location search  --}}
                    <span class="filter_search">
                            <i class="material-icons">search</i>
                            <input class="filter_search_input typeahead" type="text" name="location" placeholder="Type any location" value="{{$location}}">
                            <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();">
                    </span>

                    <a class='btn btn_green btn_clear' href="{{route('suppliers')}}"> Clear </a>

                </form>
            </span>

            {{-- business name search --}}
            <span class="filter_search">
                <form action="{{route('suppliers')}}" method="get">
                    <i class="material-icons">search</i>
                    <input class="filter_search_input" type="text" name="business_name" placeholder="business name" value="{{$business_name}}">
                    <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();">
                </form>
            </span>
        </div>
        <div class="suppliers_content_wrap">
            <div class="industries_boxWrap">
                @foreach ($suppliers as $supplier )
                    <div class="industry_infoBox">
                        <div class="box_shadow">
                            <div class="industry_logobox row">
                                <div class="col m8 l9 left"><img src="{{asset('images/frontendimages/new_layout_images/logo_global_organic.png')}}" alt=""> </div>
                                <div class="col m4 l3 right right-align"><img src="{{asset('images/frontendimages/new_layout_images/premium_badge.png')}}" alt=""></div>
                            </div>
                            <div class="industry_address">
                                <h5>{{$supplier->business_name}}</h5>
                                <p><span><img src="{{asset('images/frontendimages/new_layout_images/icon_indus_location.png')}}"></span> {{$supplier->location}}</p>
                            </div>
                            <div class="industry_details">
                                <p><img src="{{asset('images/frontendimages/new_layout_images/icon_factory.png')}}" alt=""> {{$supplier->industry_type}}</p>
                                <p><img src="{{asset('images/frontendimages/new_layout_images/icon_t_shirt.png')}}" alt=""> {{$supplier->businessCategory ? $supplier->businessCategory->name : ''}} </p>
                                <!--p><img src="{{asset('images/frontendimages/new_layout_images/icon_year.png')}}" alt=""> Established : </p-->
                            </div>


                            <!-- <p>Business Name: {{$supplier->business_name}}</p>
                            <p>Business Type:
                                @switch($supplier->business_type)
                                    @case(1)
                                        Manufacture
                                        @break
                                    @case(2)
                                        Wholesaler
                                        @break
                                    @case(3)
                                        Design Studio
                                        @break

                                    @default

                                @endswitch
                            </p>
                            <p>Industry Type: {{$supplier->industry_type}}</p>
                            <p>Business Category: {{$supplier->businessCategory ? $supplier->businessCategory->name : ''}} </p>
                            <p>Established: </p>
                            <p>Location: {{$supplier->location}}</p> -->


                            <div class="industry_view">
                                @if(Auth::guard('web')->check())
                                    <a href="{{route('supplier.profile', $supplier->id)}}">View Details</a>
                                @else
                                    <a href="#login-register-modal" class="modal-trigger">View Details</button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div>
        {{$suppliers->appends(request()->query())->links()}}
    </div>
@endsection

@include('suppliers._scripts')

@extends('layouts.app')

@section('content')
@include('sweet::alert')
@php $business_type = array_key_exists('business_type', app('request')->input())?app('request')->input('business_type'):[]; @endphp
@php $industry_type = array_key_exists('industry_type', app('request')->input())?app('request')->input('industry_type'):[]; @endphp

    <div class="suppliers_container">
        <div class="filter suppliers_filter_wrap">
            <span class="filter_box_wrap">
                <form action="{{route('suppliers')}}" method="get">
                    <span class="filter_box">
                        <a class='dropdown-trigger btn btn_white filter_dropMenu' href='#' data-target='business_type'>Business Type 
                        <i class="material-icons">arrow_drop_down</i></a>
                        <ul id='business_type' class='dropdown-content'>
                            <li><label>
                                <input type="checkbox" value="1" name="business_type[]" {{ (in_array(1, $business_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Manufactue</span>
                            </label>
                            </li>

                            <li><label>
                                <input type="checkbox" value="2" name="business_type[]" {{ (in_array(2, $business_type))?'checked':'' }} onclick="this.form.submit();"/>
                                <span>Wholesaler</span>
                            </label>
                            </li>
                        </ul>
                    </span>
                    
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
                    

                    <a class='dropdown-trigger btn btn_green btn_clear' href="{{route('suppliers')}}"> Clear </a>
                </form>
            </span>
            <span class="filter_search">
                <form action="{{route('suppliers')}}" method="get">
                    <i class="material-icons">search</i>
                    <input class="filter_search_input" type="text" name="business_name" placeholder="business name">
                    <input class="btn_green btn_search" type="submit" value="search">
                </form>
            </span>
        </div>
        <div class="suppliers_content_wrap">
            <div class="row industries_boxWrap">
                @foreach ($suppliers as $supplier )
                    <div class="col s12 m6 l4 xl3 industry_infoBox">
                        <div class="box_shadow">
                            <p>Business Name: {{$supplier->business_name}}</p>
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
                            <p>Location: {{$supplier->location}}</p>
                            <div class="industry_view">
                                <a href="{{route('supplier.profile', $supplier->id)}}">View Details</a>
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

@extends('layouts.app')

@section('content')
@include('sweet::alert')
@php $business_type = array_key_exists('business_type', app('request')->input())?app('request')->input('business_type'):[]; @endphp
@php $industry_type = array_key_exists('industry_type', app('request')->input())?app('request')->input('industry_type'):[]; @endphp

    <div>
        <div class="filter">
            <form action="{{route('suppliers')}}" method="get">
                <a class='dropdown-trigger btn' href='#' data-target='business_type'>Business Type</a>
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

                <a class='dropdown-trigger btn' href='#' data-target='industry_type'>Industry Type</a>
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

                <a class='dropdown-trigger btn' href="{{route('suppliers')}}"> Clear </a>
            </form>
            <form action="{{route('suppliers')}}" method="get">
                <input type="text" name="business_name" placeholder="business name">
                <input type="submit" value="search">
            </form>
        </div>
        <div class="row">
            @foreach ($suppliers as $supplier )
                <div class="col m3">
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
                    <a href="{{route('supplier.profile', $supplier->id)}}">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
    <div>
        {{$suppliers->appends(request()->query())->links()}}
    </div>
@endsection

@include('suppliers._scripts')

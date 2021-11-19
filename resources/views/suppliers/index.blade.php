@extends('layouts.app')

@section('content')
@include('sweet::alert')

    <div>
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

@endsection

@include('suppliers._scripts')

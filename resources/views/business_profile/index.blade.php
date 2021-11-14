@extends('layouts.app')

@section('content')
@include('sweet::alert')


<div class="row">
    <div class="col m10">
        <p>My Business List</p>
        <div class="row">
            @foreach ($business_profile  as $profile )
            <div class="col m3">
                <p>Business Name: {{$profile->business_name}}</p>
                <p>Business Type:
                    @switch($profile->business_type)
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
                <p>Location: {{$profile->location}}</p>
                <a href="{{route('business.profile.show',$profile->id)}}">View Details</a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col m2">
        <p><a href="{{route('business.profile.create')}}">Create New Business</a></p>
    </div>


</div>

@endsection

@include('business_profile._scripts')

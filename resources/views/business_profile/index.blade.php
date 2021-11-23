@extends('layouts.app')

@section('content')
@include('sweet::alert')

<div class="row business_list_wrapper">
    <div class="col m12 right-align">
        <a class="btn_green btn_create_new" href="{{route('business.profile.create')}}">Create New Business</a>
    </div>
    <div class="col m12 box_shadow_radius business_list_innar_wrapper">
        <div class="list_title"><legend>My Business List</legend></div>
        <div class="row">
            @foreach ($business_profile  as $profile )
            <div class="col m3">
                <div class="box_shadow list_box">
                    <p><span>Business Name:</span> {{$profile->business_name}}</p>
                    <p><span>Business Type:</span>
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
                    <p><span>Location:</span> {{$profile->location}}</p>
                    @if($profile->business_type==1)
                    <a class="business_view" href="{{route('business.profile.show',$profile->id)}}">View Details</a>
                    @else
                    <a class="business_view" href="{{route('wholesaler.profile.show',$profile->id)}}">View Details</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    


</div>

@endsection

@include('business_profile._scripts')

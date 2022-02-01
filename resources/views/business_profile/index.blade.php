@extends('layouts.app')

@section('content')
@include('sweet::alert')

<div class="row business_list_wrapper">
    <div class="col m12 right-align">
        <a class="btn_green btn_create_new" href="{{route('business.profile.create')}}">Create New Business</a>
    </div>
    <div class="col m12 box_shadow_radius business_list_innar_wrapper">
        <div class="list_title"><legend>My Business List</legend></div>
        <div class="business_list_inner_wrap">
            @foreach ($business_profile  as $profile )
            <div class="business_list_itembox">
                <div class="box_shadow list_box">
                    <p>
                        <span>Business Name:</span>
                        @if($profile->business_type==1)
                        <a href="{{route('manufacturer.profile.show',$profile->alias)}}">{{$profile->business_name}}</a>
                        @else
                        <a href="{{route('wholesaler.profile.show',$profile->alias)}}">{{$profile->business_name}}</a>
                        @endif
                    </p>
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
                    <p><span>Location:</span> {{ \Illuminate\Support\Str::limit($profile->location, 15, $end='...') }}</p>
                    <div class="switch profile_enable_disable_trigger">
                        <label>
                            <input type="checkbox" bpid={{$profile->id}} {{$profile->deleted_at ? '' : 'checked'}}>
                            <span class="lever"></span>
                            <span class="enable_disable_label {{$profile->deleted_at ? '' : 'teal white-text text-darken-2'}}">{{$profile->deleted_at ? 'Unpublished' : 'Published'}}</span>
                        </label>
                    </div>
                    @if($profile->business_type==1)
                    <a class="business_view" href="{{route('manufacturer.profile.show',$profile->alias)}}">View Details</a>
                    @else
                    <a class="business_view" href="{{route('wholesaler.profile.show',$profile->alias)}}">View Details</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>



</div>

@endsection

@include('business_profile._scripts')

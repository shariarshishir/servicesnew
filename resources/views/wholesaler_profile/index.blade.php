@extends('layouts.app')

@section('content')
@include('sweet::alert')
@include('wholesaler_profile.partials._profile_list')

<div id="profile" class="col s12">@include('wholesaler_profile.profile_info.index')</div>

@endsection

@include('wholesaler_profile.partials._scripts')

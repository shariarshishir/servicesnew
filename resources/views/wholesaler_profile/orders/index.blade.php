@extends('layouts.app')

@section('content')

@include('wholesaler_profile.partials._profile_list')

<div id="orders" class="col s12">@include('wholesaler_profile.orders._partial_index')</div>


@endsection

@include('wholesaler_profile.partials._scripts')

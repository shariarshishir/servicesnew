@extends('layouts.app')

@section('content')
@include('sweet::alert')


<div class="row">
   <p>Business Profile</p>
   <p>Business name:{{$business_profile->business_name}}</p>

</div>

@endsection

@include('business_profile._scripts')

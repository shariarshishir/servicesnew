@extends('layouts.app_anonymous')
@section('content')
<h3>Welcome to Merchant Bay.</h3>
<form method="POST" action="{{ route('anonymous.password.update') }}">
    @csrf
    <input type="password" name="newpassword" value="" />
    <input type="hidden" name="email" value="{{$decryptAuthInfo->email}}" />
    <input type="hidden" name="oldpassword" value="{{$decryptAuthInfo->password}}" />
    <input type="submit" value="Submit" class="btn btn_green" />
</form>
@endsection

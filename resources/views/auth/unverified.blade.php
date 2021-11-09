@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-with-padding">
                <div class="card-header">{{ __('Email Verification') }}</div>

                <div class="card-body" style="text-align:center;">
                    <p>You need to confirm your account. We have sent you an activation link. Please check your email.</p>
                    <p>If you want to resend the activation link plesae <a href="javascript:void(0);" id="resend-email-validtion">click here</a></p>
                </div>
                <div id="resend-email-verification-form" style="display:none">
                    <div class="card-alert card cyan">
                        <div class="card-content white-text">
                            <p>INFO : Please provide your email address that you have used for the registration.</p>
                        </div>
                    </div>                
                    <form  action="{{route('resend.verification_email')}}" method="post">
                        <div class="row">
                            <div class="input-field col s4">
                                <i class="material-icons prefix">email</i>
                                <input type="text" name="email">
                                <label for="email">Email</label>
                            </div>
                            <button class="btn green darken-1 waves-effect waves-light" type="submit">
                                Submit <i class="material-icons right">send</i>
                            </button>                        
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

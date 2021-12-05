@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center business_profile_login">

        <div class="row card business_login_inner">
            <div class="col m5 registration-block">
                <div class="company-logo">
                    <img src="http://127.0.0.1:8000/images/frontendimages/merchantbay_logoX200.png" alt="Merchant Bay Logo">
                </div>
                <div class="registration-content">
                    <p>Not Yet Registered ?</p>

                    <a href="{{env('SSO_REGISTRATION_URL').'/?flag=service'}}"> Click here to Register</a>
                </div>
            </div>
                <div class="col m7 login-block">
                    <!-- <div class="card-header">{{ __('Login') }}</div> -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                    <div class=" input_box_wrap">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <span class="text-danger error-text email_err"></span>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 password-block-wrap">
                                    <label for="password" class="">{{ __('Password') }}</label>
                                    <div class=" input_box_wrap">
                                        <i class="material-icons prefix">lock_outline</i>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row remember-me-block">
                                <div class="input-field col s12">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Remember Me</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn_green signin right">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn_green right btn-forgot-password" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </form>
                    </div>

            </div>
        </div>







        <!-- <div class="col-md-8">
            <div class="card card-with-padding">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row remember-me-block">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember Me</span>
                            </label>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn waves-effect waves-light green">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn waves-effect waves-light green" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->




    </div>
</div>
@endsection

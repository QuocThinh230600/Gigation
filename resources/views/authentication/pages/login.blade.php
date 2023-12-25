@extends('authentication.master')
@section('title', module('login'))

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
@endpush

@section('content')
    <!-- Login form -->
    <form action="{{ route('auth.login') }}" class="flex-fill" method="POST" id="formAuth" autocomplete="off" style="width: 35rem">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                @include('authentication.partials.alert')

                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">{{ label('login.login_to_your_account') }}</h5>
                            <span class="d-block text-muted">{{ label('login.your_credentials') }}</span>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="email" class="form-control" name="email" placeholder="{{ placeholder('login.email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="{{ placeholder('login.password') }}">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control" name="captcha" placeholder="{!! placeholder('register.captcha') !!}" value="{{ old('captcha') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-barcode2 text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-success btn-refresh" data-url="{{ route('auth.captcha') }}"><i class="icon-spinner11"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center">
                            <div class="form-check mb-0">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-input-styled"/>
                                    {{ label('login.remember') }}
                                </label>
                            </div>

                            <a href="{{ route('auth.showForgotForm') }}" class="ml-auto">{{ label('login.forgot_password') }}</a>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">{{ label('login.sign_in_button') }}
                                <i class="icon-circle-right2 ml-2"></i>
                            </button>
                        </div>

                        @if (env('FACEBOOK_CLIENT_ID') != NULL || env('GOOGLE_CLIENT_ID') != NULL)
                        <div class="form-group text-center text-muted content-divider">
                            <span class="px-2">{{ label('login.or_sign_in_with') }}</span>
                        </div>
                        @endif

                        <div class="form-group text-center">
                            @if (env('FACEBOOK_CLIENT_ID') != NULL)
                            <a href="{{ route('auth.redirectToProvider', ['provider' => 'facebook']) }}" class="btn btn-outline bg-indigo border-indigo text-indigo btn-icon rounded-round border-2"><i class="icon-facebook"></i></a>
                            @endif

                            @if (env('GOOGLE_CLIENT_ID') != NULL)
                            <a href="{{ route('auth.redirectToProvider', ['provider' => 'google']) }}" class="btn btn-outline bg-pink-300 border-pink-300 text-pink-300 btn-icon rounded-round border-2 ml-2"><i class="icon-google"></i></a>
                            @endif
                        </div>


                        <div class="form-group text-center text-muted content-divider">
                            <span class="px-2">{{ label('login.dont_have_an_account') }}</span>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('auth.register') }}" class="btn btn-light btn-block">{{ label('login.sign_up_button') }}</a>
                        </div>

                        <span class="form-text text-center text-muted">{!! label('login.policy_login') !!}</span>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <!-- /login form -->
@endsection

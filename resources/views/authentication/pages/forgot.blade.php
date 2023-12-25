@extends('authentication.master')
@section('title', module('forgot_password'))

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
@endpush

@section('content')
    <!-- Password recovery form -->
    <form class="flex-fill" action="{{ route('auth.forgot') }}" method="POST" id="formAuth" style="width: 35rem">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                @include('authentication.partials.alert')

                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">{{ label('forgot.password_recovery') }}</h5>
                            <span class="d-block text-muted">{{ label('forgot.send_email_password_confirm') }}</span>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="email" class="form-control" name="email" placeholder="{{ placeholder('forgot.email') }}" value="{{ old('email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-user-plus text-muted"></i>
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

                        <button type="submit" class="btn bg-blue btn-block">
                            <i class="icon-spinner11 mr-2"></i>
                            {{ label('forgot.reset_password_button') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->
@endsection

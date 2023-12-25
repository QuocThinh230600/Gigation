@extends('authentication.master')
@section('title', module('register'))

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
@endpush

@section('content')
    <!-- Registration form -->
    <form action="{{ route('auth.register') }}" class="flex-fill" method="POST" id="formAuth" style="width: 35rem">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                @include('authentication.partials.alert')

                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">{{ label('register.create_account') }}</h5>
                            <span class="d-block text-muted">{{ label('register.all_fields_are_required') }}</span>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="email" class="form-control" name="email" placeholder="{{ placeholder('register.email') }}" value="{{ old('email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-user-plus text-muted"></i>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="password" class="form-control" name="password" placeholder="{{ placeholder('register.password') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="{{ placeholder('register.password_confirm') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control" name="full_name" placeholder="{{ placeholder('register.full_name') }}" value="{{ old('full_name') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-vcard text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control" name="phone" placeholder="{{ placeholder('register.phone') }}" value="{{ old('phone') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-phone text-muted"></i>
                                    </div>
                                </div>
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

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-input-styled" checked data-fouc>
                                    {{ label('register.receive_email_register') }}
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="accept_condition" class="form-input-styled accept-condition-register" data-fouc>
                                    {!! label('register.accept_terms') !!}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block bg-teal-400 btn-labeled btn-labeled-right">
                                <b><i class="icon-plus3"></i></b>
                                {!! label('register.create_account_button') !!}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /registration form -->
@endsection

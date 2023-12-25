@extends('administrator.master')
@section('module', module('language'))
@section('action', behavior('action.create'))
@section('title', title_module('language', 'create'))

@canany(['language_index', 'language_edit', 'language_destroy'])
    @section('index', route('admin.language.index'))
@endcanany

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'media/fancybox.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <form action="{{ route('admin.language.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.language.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="language.name" type="text" name="name" placeholder="language.name" required="required">
                        {{ old('name') }}
                    </x-text>

                    <x-text label="language.locale" type="text" name="locale" placeholder="language.locale" required="required">
                        {{ old('locale') }}
                    </x-text>

                    <x-text label="language.timezone" type="text" name="timezone" placeholder="language.timezone" required="required">
                        {{ old('timezone') }}
                    </x-text>

                    <x-text label="language.currency" type="text" name="currency" placeholder="language.currency" required="required">
                        {{ old('currency') }}
                    </x-text>

                    <x-text label="language.exchange_rate" type="text" name="exchange_rate" placeholder="language.exchange_rate" required="required">
                        {{ old('exchange_rate') }}
                    </x-text>

                    <x-selectbox label="language.format_date" name="format_date" :dataSelect="format_date()">
                        {{ old('format_date') }}
                    </x-selectbox>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-image name="flag">
                        {{ old('flag') }}
                    </x-image>

                    <x-toggle label="element.status" name="status" on="element.status_enable" off="element.status_disable" required="required">
                        {{ old('status','on') }}
                    </x-toggle>


                    @if ($default)
                        <x-toggle label="element.default" name="default" on="element.default_yes" off="element.default_no" required="required">
                            {{ old('default','on') }}
                        </x-toggle>
                    @else
                        <x-toggle label="element.default" name="default" on="element.default_yes" off="element.default_no" disabled="disabled">
                            {{ old('default','off') }}
                        </x-toggle>

                        <span>{{ trans('message.language.default_checked') }}</span>
                    @endif

                </x-card>
            </div>
        </div>
    </form>
@endsection

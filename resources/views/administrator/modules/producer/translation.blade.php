@extends('administrator.master')
@section('module', module('producer'))
@section('action', behavior('action.translation'))
@section('title', title_module('producer','translation'))

@canany(['producer_index', 'producer_edit', 'producer_destroy'])
    @section('index', route('admin.producer.index'))
@endcanany

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'media/fancybox.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <form action="{{ route('admin.producer.translation', ['producer' => $producer->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.producer.index')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-right">
                    <x-language label="producer.locale" name="locale_origin" placeholder="producers_position.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin', $producer->locale) }}
                    </x-language>

                    <x-text label="producer.name" type="text" name="name_origin" placeholder="producer.name" required="required">
                        {{ old('name_origin', $producer->name) }}
                    </x-text>

                    <x-text label="producer.address" type="text" name="address_origin" placeholder="producer.address" required="required">
                        {{ old('address_origin', $producer->address) }}
                    </x-text>

                    <x-text label="producer.phone" type="text" name="phone_origin" placeholder="producer.phone" required="required">
                        {{ old('phone_origin', $producer->phone) }}
                    </x-text>

                    <x-text label="producer.email" type="email" name="email_origin" placeholder="producer.email" required="required">
                        {{ old('email_origin', $producer->email) }}
                    </x-text>

                    <x-editor label="producer.description" name="description_origin">
                        {{ old('description_origin', $producer->description) }}
                    </x-editor>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-right">
                    <x-language label="producer.locale" name="locale" placeholder="producers_position.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

                    <x-text label="producer.name" type="text" name="name" placeholder="producer.name" required="required">
                        {{ old('name') }}
                    </x-text>

                    <x-text label="producer.address" type="text" name="address" placeholder="producer.address" required="required">
                        {{ old('address') }}
                    </x-text>

                    <x-text label="producer.phone" type="text" name="phone" placeholder="producer.phone" required="required">
                        {{ old('phone') }}
                    </x-text>

                    <x-text label="producer.email" type="email" name="email" placeholder="producer.email" required="required">
                        {{ old('email') }}
                    </x-text>

                    <x-editor label="producer.description" name="description">
                        {{ old('description') }}
                    </x-editor>
                </x-card>
            </div>
        </div>
    </form>
@endsection

@extends('administrator.master')
@section('module', module('producer'))
@section('action', behavior('action.create'))
@section('title', title_module('producer','create'))

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
    <form action="{{ route('admin.producer.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.producer.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
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

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-toggle label="element.status" name="status" on="element.status_enable"  off="element.status_disable" required="required">
                        {{ old('status','on') }}
                    </x-toggle>

                    <x-image name="image">
                        {{ old('image') }}
                    </x-image>
                </x-card>
            </div>

        </div>
    </form>
@endsection

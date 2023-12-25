@extends('administrator.master')
@section('module', module('province'))
@section('action', behavior('action.edit'))
@section('title', title_module('province', 'edit'))

@canany(['province_index', 'province_edit', 'province_destroy'])
    @section('index', route('admin.province.index'))
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
    <form action="{{ route('admin.province.update', ['province' => $province->id]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.province.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="province.gso_id" type="text" name="gso_id" placeholder="province.gso_id" required="required">
                        {{ old('gso_id', $province->gso_id) }}
                    </x-text>

                    <x-text label="province.name" type="text" name="name" placeholder="province.name" required="required">
                        {{ old('name', $province->name) }}
                    </x-text>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-toggle label="element.status" name="status" on="element.status_enable" off="element.status_disable" required="required">
                        {{ old('status', $province->status) }}
                    </x-toggle>

                    <x-toggle label="element.featured" name="featured" on="element.default_yes" off="element.default_no" required="required">
                        {{ old('featured', $province->featured) }}
                    </x-toggle>
                </x-card>
            </div>
        </div>
    </form>
@endsection

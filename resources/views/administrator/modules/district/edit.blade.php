@extends('administrator.master')
@section('module', module('district'))
@section('action', behavior('action.edit'))
@section('title', title_module('district', 'edit'))

@canany(['district_index', 'district_edit', 'district_destroy'])
    @section('index', route('admin.district.index'))
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
    <form action="{{ route('admin.district.update', ['district' => $district->id]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.district.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-selectbox label="province.name" name="province_id" :dataSelect="$provinces" required="required">
                        {{ old('province_id', $district->province_id) }}
                    </x-selectbox>

                    <x-text label="district.gso_id" type="text" name="gso_id" placeholder="district.gso_id" required="required">
                        {{ old('gso_id', $district->gso_id) }}
                    </x-text>

                    <x-text label="district.name" type="text" name="name" placeholder="district.name" required="required">
                        {{ old('name', $district->name) }}
                    </x-text>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-toggle label="element.status" name="status" on="element.status_enable" off="element.status_disable" required="required">
                        {{ old('status', $district->status) }}
                    </x-toggle>

                    <x-toggle label="element.featured" name="featured" on="element.default_yes" off="element.default_no" required="required">
                        {{ old('featured', $district->featured) }}
                    </x-toggle>
                </x-card>
            </div>
        </div>
    </form>
@endsection

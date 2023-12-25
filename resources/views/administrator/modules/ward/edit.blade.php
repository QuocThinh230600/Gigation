@extends('administrator.master')
@section('module', module('ward'))
@section('action', behavior('action.edit'))
@section('title', title_module('ward', 'edit'))

@canany(['ward_index', 'ward_edit', 'ward_destroy'])
    @section('index', route('admin.ward.index'))
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
    <form action="{{ route('admin.ward.update', ['ward' => $ward->id]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.ward.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-selectbox label="province.name" name="province_id" :dataSelect="$provinces" required="required">
                        {{ old('province_id', $province_id) }}
                    </x-selectbox>

                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('district.name') }} <span class="text-danger">*</span></label>

                        <select class="form-control filter-select" name="district_id" data-url="{{ route('admin.ajax.loadDistrict') }}">
                            @foreach ($district as $item)
                                <option value="{{ $item->id }}" {{ (old('district_id', $ward->district_id) == $item->id) ? 'selected' : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-text label="ward.gso_id" type="text" name="gso_id" placeholder="ward.gso_id" required="required">
                        {{ old('gso_id', $ward->gso_id) }}
                    </x-text>

                    <x-text label="ward.name" type="text" name="name" placeholder="ward.name" required="required">
                        {{ old('name', $ward->name) }}
                    </x-text>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-toggle label="element.status" name="status" on="element.status_enable" off="element.status_disable" required="required">
                        {{ old('status', $ward->status) }}
                    </x-toggle>

                    <x-toggle label="element.featured" name="featured" on="element.default_yes" off="element.default_no" required="required">
                        {{ old('featured', $ward->featured) }}
                    </x-toggle>
                </x-card>
            </div>
        </div>
    </form>
@endsection

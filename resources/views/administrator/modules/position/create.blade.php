@extends('administrator.master')
@section('module', module('position'))
@section('action', behavior('action.create'))
@section('title', title_module('position','create'))

@canany(['position_index', 'position_edit', 'position_destroy'])
    @section('index', route('admin.position.index'))
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
    <form action="{{ route('admin.position.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.position.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="position.name" type="text" name="name" placeholder="position.name" required="required">
                        {{ old('name') }}
                    </x-text>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-text label="position.width" type="text" name="width" placeholder="position.width" required="required">
                                {{ old('width') }}
                            </x-text>
                        </div>

                        <div class="col-lg-6">
                            <x-text label="position.height" type="text" name="height" placeholder="position.height" required="required">
                                {{ old('height') }}
                            </x-text>
                        </div>
                    </div>

                    <x-text label="position.link" type="text" name="link" placeholder="position.link" required="required">
                        {{ old('link') }}
                    </x-text>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('position.parent') }}</label>
                        <select class="form-control" name="parent_id" data-url="{{ route('admin.ajax.ajaxSelectPosition') }}">
                            <option value="1">------------ ROOT ------------</option>
                            @php
                                recursiveSelect($parent, old('parent_id'))
                            @endphp
                        </select>
                    </div>

                    <x-text label="position.position" type="text" name="position" placeholder="category.position">
                        {{ old('position',$root_position_max) }}
                    </x-text>

                    <x-selectbox label="element.open_link" name="open_link" :dataSelect="open_link()" required="required">
                        {{ old('open_link') }}
                    </x-selectbox>

                    <x-multiple label="element.access" name="access[]" :dataSelect="level()" required="required">
                        {{ old('level','1,2') }}
                    </x-multiple>

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

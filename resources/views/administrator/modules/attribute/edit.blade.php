@extends('administrator.master')
@section('module', module('attribute'))
@section('action', behavior('action.edit'))
@section('title', title_module('attribute','edit'))

@canany(['attribute_index', 'attribute_edit', 'attribute_destroy'])
    @section('index', route('admin.attribute.index'))
@endcanany

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'media/fancybox.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/inputs/maxlength.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/tags/tokenfield.min.js') }}"></script>
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
    <form action="{{ route('admin.attribute.update', ['attribute' => $attribute->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.attribute.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="attribute.name" type="text" name="name" placeholder="attribute.name" slug="slug_name" title="title_name" required="required">
                        {{ old('name', $attribute->name) }}
                    </x-text>

                    <x-editor label="attribute.description" name="description">
                        {{ old('description', $attribute->description) }}
                    </x-editor>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('attribute.parent') }} <span class="text-danger">*</span></label>
                        <select class="form-control parent_position" name="parent_id" data-url="{{ route('admin.ajax.ajaxSelectAttribute') }}">
                            <option value="1">------------ ROOT ------------</option>
                            @php
                                recursiveSelect($parent, old('parent_id', $attribute->parent_id))
                            @endphp
                        </select>
                    </div>

                    <x-text label="attribute.position" type="text" name="position" placeholder="attribute.position" required="required">
                        {{ old('position', $attribute->position) }}
                    </x-text>

                    <x-toggle label="element.status" name="status" on="element.status_enable"  off="element.status_disable" required="required">
                        {{ old('status', $attribute->status) }}
                    </x-toggle>
                </x-card>
            </div>

        </div>
    </form>
@endsection

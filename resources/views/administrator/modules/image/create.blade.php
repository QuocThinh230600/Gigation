@extends('administrator.master')
@section('module', module('image'))
@section('action', behavior('action.create'))
@section('title', title_module('image','create'))

@canany(['image_index', 'image_edit', 'image_destroy'])
    @section('index', route('admin.image.index'))
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
    <form action="{{ route('admin.image.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.image.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="images_position.name" type="text" name="name" placeholder="images_position.name" required="required">
                        {{ old('name') }}
                    </x-text>

                    <x-editor label="images_position.script_code" name="script_code">
                        {{ old('script_code') }}
                    </x-editor>

                    <x-editor label="images_position.description" name="description">
                        {{ old('description') }}
                    </x-editor>

                    <x-text label="images_position.link" type="text" name="link" placeholder="images_position.link" required="required">
                        {{ old('link') }}
                    </x-text>

                    <x-youtube name="video" label="images_position.video" placeholder="images_position.video">
                        {{ old('video') }}
                    </x-youtube>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('images_position.position_image') }}</label>
                        <select class="form-control parent_position" name="position_id" data-url="{{ route('admin.ajax.ajaxSelectPositionImages') }}">
                            <option value="1">------------ ROOT ------------</option>
                            @php
                                recursiveSelect($position, old('position_id'))
                            @endphp
                        </select>
                    </div>

                    <x-text label="images_position.position" type="text" name="position" placeholder="category.position">
                        {{ old('position',$root_position_max) }}
                    </x-text>

                    <x-selectbox label="element.open_link" name="open_link" :dataSelect="open_link()" required="required">
                        {{ old('open_link') }}
                    </x-selectbox>

                    <x-multiple label="element.access" name="access[]" :dataSelect="level()" required="required">
                        {{ old('access','1,2') }}
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

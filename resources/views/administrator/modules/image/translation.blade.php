@extends('administrator.master')
@section('module', module('image'))
@section('action', behavior('action.translation'))
@section('title', title_module('image','translation'))

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
    <form action="{{ route('admin.image.translation', ['image' => $image->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.image.index')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-right">
                    <x-language label="images_position.locale" name="locale_origin" placeholder="images_position.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin', $image->locale) }}
                    </x-language>

                    <x-text label="images_position.name" type="text" name="name_origin" placeholder="images_position.name" required="required">
                        {{ old('name_origin', $image->name) }}
                    </x-text>

                    <x-editor label="images_position.script_code" name="script_code_origin">
                        {{ old('script_code_origin', $image->script_code) }}
                    </x-editor>

                    <x-editor label="images_position.description" name="description_origin">
                        {{ old('description_origin', $image->description) }}
                    </x-editor>

                    <x-text label="images_position.link" type="text" name="link_origin" placeholder="images_position.link" required="required">
                        {{ old('link_origin', $image->link) }}
                    </x-text>

                    <x-youtube name="video" label="images_position.video" placeholder="images_position.video">
                        {{ old('video_origin', $image->video) }}
                    </x-youtube>

                    <x-image name="image_origin">
                        {{ old('image_origin', $image->image) }}
                    </x-image>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-right">
                    <x-language label="images_position.locale" name="locale" placeholder="images_position.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

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

                    <x-image name="image">
                        {{ old('image') }}
                    </x-image>
                </x-card>
            </div>
        </div>
    </form>
@endsection

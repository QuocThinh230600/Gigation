@extends('administrator.master')
@section('module', module('content'))
@section('action', behavior('action.translation'))
@section('title', title_module('content','translation'))

@canany(['content_index', 'content_edit', 'content_destroy'])
    @section('index', route('admin.content.index', ['page' => $page->uuid]))
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
    <div class="alert alert-info border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        <span class="font-weight-semibold">{{ label('content.alert') }}</span>{{ trans('form.content.page_content_code', ['page' => $page->name, 'code' => $content->code]) }}
    </div>

    <form action="{{ route('admin.content.translation',['page' => $page->uuid, 'content' => $content->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.content.index', ['page' => $page->uuid])])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="content.locale" name="locale_origin" placeholder="content.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin', $content->locale) }}
                    </x-language>

                    <x-editor label="content.content" name="content_origin">
                        {{ old('content_origin', $content->content) }}
                    </x-editor>

                    <x-image name="image_origin">
                        {{ old('image_origin', $content->image) }}
                    </x-image>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-right">
                    <x-language label="content.locale" name="locale" placeholder="content.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

                    <x-editor label="content.content" name="content">
                        {{ old('content_origin') }}
                    </x-editor>

                    <x-image name="image">
                        {{ old('image') }}
                    </x-image>
                </x-card>
            </div>
        </div>
    </form>
@endsection

@extends('administrator.master')
@section('module', module('attribute'))
@section('action', behavior('action.translation'))
@section('title', title_module('attribute','translation'))

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
    <form action="{{ route('admin.attribute.translation',['attribute' => $attribute->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.attribute.index')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="page.locale" name="locale_origin" placeholder="page.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin', $attribute->locale) }}
                    </x-language>

                    <x-text label="attribute.name" type="text" name="name_origin" placeholder="attribute.name" slug="slug_name" title="title_name" required="required">
                        {{ old('name_origin', $attribute->name) }}
                    </x-text>

                    <x-editor label="attribute.description" name="description_origin">
                        {{ old('description_origin', $attribute->description) }}
                    </x-editor>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="page.locale" name="locale" placeholder="page.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

                    <x-text label="attribute.name" type="text" name="name" placeholder="attribute.name" slug="slug_name" title="title_name" required="required">
                        {{ old('name') }}
                    </x-text>

                    <x-editor label="attribute.description" name="description">
                        {{ old('description') }}
                    </x-editor>
                </x-card>
            </div>
        </div>
    </form>
@endsection

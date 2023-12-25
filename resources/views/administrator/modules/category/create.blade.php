@extends('administrator.master')
@section('module', module('category'))
@section('action', behavior('action.create'))
@section('title', title_module('category','create'))

@canany(['category_index', 'category_edit', 'category_destroy'])
    @section('index', route('admin.category.index'))
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
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.category.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="category.name" type="text" name="name" placeholder="category.name" slug="slug_name" title="title_name" required="required">
                        {{ old('name') }}
                    </x-text>

                    <x-text label="category.link" type="text" name="link" placeholder="category.link">
                        {{ old('link') }}
                    </x-text>

                    <x-editor label="category.title" name="title">
                        {{ old('title') }}
                    </x-editor>

                    <x-editor label="category.description" name="description">
                        {{ old('description') }}
                    </x-editor>

                    <x-editor label="category.content" name="content">
                        {{ old('content') }}
                    </x-editor>
                </x-card>

                <x-card title="action.seo" id="forms-target-left">
                    <x-multiple label="seo.meta_robots" name="meta_robots[]" :dataSelect="robot()" required="required">
                        {{ old('meta_robots','index,follow') }}
                    </x-multiple>

                    <x-multiple label="seo.meta_google_bot" name="meta_google_bot[]" :dataSelect="robot()" required="required">
                        {{ old('meta_google_bot','index,follow') }}
                    </x-multiple>

                    <x-text label="seo.slug" type="text" name="slug" placeholder="seo.slug" id="slug_name" required="required">
                        {{ old('slug') }}
                    </x-text>

                    <x-text label="seo.title_tag" type="text" name="title_tag" placeholder="seo.title_tag" id="title_name" required="required">
                        {{ old('title_tag') }}
                    </x-text>

                    <x-tag label="seo.meta_keywords" name="meta_keywords" placeholder="seo.meta_description">
                        {{ old('meta_keywords') }}
                    </x-tag>

                    <x-description label="seo.meta_description" name="meta_description" placeholder="seo.meta_description">
                        {{ old('meta_description') }}
                    </x-description>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('category.parent') }} <span class="text-danger">*</span></label>
                        <select class="form-control parent_position" name="parent_id" data-url="{{ route('admin.ajax.ajaxSelectCategory') }}">
                            <option value="1">------------ ROOT ------------</option>
                            @php
                                recursiveSelect($parent, old('parent_id'))
                            @endphp
                        </select>
                    </div>

                    <x-text label="category.position" type="text" name="position" placeholder="category.position" required="required">
                        {{ old('position',$root_position_max) }}
                    </x-text>

                    <x-selectbox label="element.open_link" name="open_link" :dataSelect="open_link()" required="required">
                        {{ old('open_link') }}
                    </x-selectbox>

                    <x-multiple label="element.access" name="access[]" :dataSelect="level()" required="required">
                        {{ old('access','1,2') }}
                    </x-multiple>

                    <x-text label="category.icon" type="text" name="icon" placeholder="category.icon">
                        {{ old('icon') }}
                    </x-text>

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

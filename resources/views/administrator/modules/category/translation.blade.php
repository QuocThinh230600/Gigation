@extends('administrator.master')
@section('module', module('category'))
@section('action', behavior('action.translation'))
@section('title', title_module('category','translation'))

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
    <form action="{{ route('admin.category.translation',['category' => $category->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.category.index')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="page.locale" name="locale_origin" placeholder="page.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin') }}
                    </x-language>

                    <x-text label="category.name" type="text" name="name_origin" placeholder="category.name">
                        {{ old('name_origin', $category->name) }}
                    </x-text>

                    <x-text label="category.link" type="text" name="link_origin" placeholder="category.link">
                        {{ old('link_origin', $category->link) }}
                    </x-text>

                    <x-editor label="category.description" name="description_origin">
                        {{ old('description_origin', $category->description) }}
                    </x-editor>

                    <x-image name="image_origin">
                        {{ old('image_origin',$category->image) }}
                    </x-image>
                </x-card>

                <x-card title="action.seo" id="forms-target-left">
                    <x-multiple label="seo.meta_robots" name="meta_robots_origin[]" :dataSelect="robot()">
                        {{ old('meta_robots_origin', $category->meta_robots) }}
                    </x-multiple>

                    <x-multiple label="seo.meta_google_bot" name="meta_google_bot_origin[]" :dataSelect="robot()">
                        {{ old('meta_google_bot_origin', $category->meta_google_bot) }}
                    </x-multiple>

                    <x-text label="seo.slug" type="text" name="slug_origin" placeholder="seo.slug">
                        {{ old('slug_origin', $category->slug) }}
                    </x-text>

                    <x-text label="seo.title_tag" type="text" name="title_tag_origin" placeholder="seo.title_tag">
                        {{ old('title_tag_origin', $category->title_tag) }}
                    </x-text>

                    <x-tag label="seo.meta_keywords" name="meta_keywords_origin" placeholder="seo.meta_description">
                        {{ old('meta_keywords_origin', $category->meta_keywords) }}
                    </x-tag>

                    <x-description label="seo.meta_description" name="meta_description_origin" placeholder="seo.meta_description">
                        {{ old('meta_description_origin', $category->meta_description) }}
                    </x-description>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="page.locale" name="locale" placeholder="page.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

                    <x-text label="category.name" type="text" name="name" placeholder="category.name" slug="slug_name" title="title_name">
                        {{ old('name') }}
                    </x-text>

                    <x-text label="category.link" type="text" name="link" placeholder="category.link">
                        {{ old('link') }}
                    </x-text>

                    <x-editor label="category.description" name="description">
                        {{ old('description') }}
                    </x-editor>

                    <x-image name="image">
                        {{ old('image') }}
                    </x-image>
                </x-card>

                <x-card title="action.seo" id="forms-target-left">
                    <x-multiple label="seo.meta_robots" name="meta_robots[]" :dataSelect="robot()">
                        {{ old('meta_robots','index,follow') }}
                    </x-multiple>

                    <x-multiple label="seo.meta_google_bot" name="meta_google_bot[]" :dataSelect="robot()">
                        {{ old('meta_google_bot','index,follow') }}
                    </x-multiple>

                    <x-text label="seo.slug" type="text" name="slug" placeholder="seo.slug" id="slug_name">
                        {{ old('slug') }}
                    </x-text>

                    <x-text label="seo.title_tag" type="text" name="title_tag" placeholder="seo.title_tag" id="title_name">
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
        </div>
    </form>
@endsection

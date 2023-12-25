@extends('administrator.master')
@section('module', module('product'))
@section('action', behavior('action.translation'))
@section('title', title_module('product','translation'))

@canany(['product_index', 'product_edit', 'product_destroy'])
    @section('index', route('admin.product.index'))
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
    <form action="{{ route('admin.product.translation', ['product' => $product->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.product.index')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="content.locale" name="locale_origin" placeholder="content.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin',$product->locale) }}
                    </x-language>

                    <x-text label="product.name" type="text" name="name_origin" placeholder="product.name">
                        {{ old('name_origin',$product->name) }}
                    </x-text>

                    <x-text label="product.price" type="text" name="price_origin" placeholder="product.price">
                        {{ old('price_origin',$product->price) }}
                    </x-text>

                    <x-text label="product.discount" type="text" name="discount_origin" placeholder="product.discount">
                        {{ old('discount_origin',$product->discount) }}
                    </x-text>

                    <x-editor label="product.description" name="description_origin">
                        {{ old('description_origin',$product->description) }}
                    </x-editor>

                    <x-editor label="product.content" name="content_origin">
                        {{ old('content_origin',$product->content) }}
                    </x-editor>

                </x-card>

                <x-card title="action.info" id="forms-target-left">
                    <x-image name="image_origin">
                        {{ old('image_origin',$product->image) }}
                    </x-image>

                    <x-youtube name="youtube_origin" label="product.youtube" placeholder="product.youtube">
                        {{ old('youtube_origin',$product->youtube) }}
                    </x-youtube>

                    <x-file label="product.file" name="file_origin" placeholder="product.file">
                        {{ old('file_origin',$product->file) }}
                    </x-file>
                </x-card>

                <x-card title="action.seo" id="forms-target-left">
                    <x-multiple label="seo.meta_robots" name="meta_robots_origin[]" :dataSelect="robot()">
                        {{ old('meta_robots_origin',$product->meta_robots) }}
                    </x-multiple>

                    <x-multiple label="seo.meta_google_bot" name="meta_google_bot_origin[]" :dataSelect="robot()">
                        {{ old('meta_google_bot_origin',$product->meta_google_bot) }}
                    </x-multiple>

                    <x-text label="seo.slug" type="text" name="slug_origin" placeholder="seo.slug">
                        {{ old('slug_origin',$product->slug) }}
                    </x-text>

                    <x-text label="seo.title_tag" type="text" name="title_tag_origin" placeholder="seo.title_tag">
                        {{ old('title_tag_origin',$product->title_tag) }}
                    </x-text>

                    <x-tag label="seo.meta_keywords" name="meta_keywords_origin" placeholder="seo.meta_description">
                        {{ old('meta_keywords_origin',$product->meta_keywords) }}
                    </x-tag>

                    <x-description label="seo.meta_description" name="meta_description_origin" placeholder="seo.meta_description">
                        {{ old('meta_description_origin',$product->meta_description) }}
                    </x-description>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="content.locale" name="locale" placeholder="content.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

                    <x-text label="product.name" type="text" name="name" placeholder="product.name" slug="slug_name" title="title_name">
                        {{ old('name') }}
                    </x-text>

                    <x-text label="product.price" type="text" name="price" placeholder="product.price">
                        {{ old('price') }}
                    </x-text>

                    <x-text label="product.discount" type="text" name="discount" placeholder="product.discount">
                        {{ old('discount') }}
                    </x-text>

                    <x-editor label="product.description" name="description">
                        {{ old('description') }}
                    </x-editor>

                    <x-editor label="product.content" name="content">
                        {{ old('content') }}
                    </x-editor>
                </x-card>

                <x-card title="action.info" id="forms-target-right">
                    <x-image name="image">
                        {{ old('image') }}
                    </x-image>

                    <x-youtube name="youtube" label="product.youtube" placeholder="product.youtube">
                        {{ old('youtube') }}
                    </x-youtube>

                    <x-file label="product.file" name="file" placeholder="product.file">
                        {{ old('file') }}
                    </x-file>
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

@extends('administrator.master')
@section('module', module('product'))
@section('action', behavior('action.edit'))
@section('title', title_module('product','edit'))

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
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'extensions/jquery_ui/widgets.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <form action="{{ route('admin.product.update',['product' => $product->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.product.index')])

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-transparent border-bottom header-elements-inline">

                        <h6 class="card-title">{{ behavior('action.info') }}</h6>

                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="fullscreen"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light">
                        <ul class="nav nav-tabs nav-tabs-bottom mb-0">
                            <li class="nav-item">
                                <a href="#card-toolbar-tab1" class="nav-link active" data-toggle="tab">
                                    <i class="icon-cube mr-2"></i>
                                    {{ behavior('action.content') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#card-toolbar-tab2" class="nav-link" data-toggle="tab">
                                    <i class="icon-image2 mr-2"></i>
                                    {{ behavior('action.secondary_image') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body tab-content" id="forms-target-left">
                        <div class="tab-pane fade show active" id="card-toolbar-tab1">
                            <x-text label="product.name" type="text" name="name" placeholder="product.name" slug="slug_name" title="title_name" required="required">
                                {{ old('name', $product->name) }}
                            </x-text>

                            <div class="row">
                                <div class="col-lg-6">
                                    <x-text label="product.price" type="text" name="price" placeholder="product.price" required="required">
                                        {{ old('price', $product->price) }}
                                    </x-text>
                                </div>

                                <div class="col-lg-6">
                                    <x-text label="product.discount" type="text" name="discount" placeholder="product.discount">
                                        {{ old('discount', $product->discount) }}
                                    </x-text>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <x-datetime label="product.date_start" name="date_start" placeholder="product.date_start">
                                        {{ date('d/m/Y',time()) }}
                                    </x-datetime>
                                </div>

                                <div class="col-md-2">
                                    <label>{{ label('product.time_start') }}</label>
                                    <select name="time_start" class="form-control">
                                        {!! time_24_hours() !!}
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <x-datetime label="product.date_end" name="date_end" placeholder="product.date_end">
                                        {{ date('d/m/Y') }}
                                    </x-datetime>
                                </div>

                                <div class="col-md-2">
                                    <label>{{ label('product.time_end') }}</label>
                                    <select name="time_end" class="form-control">
                                        {!! time_24_hours() !!}
                                    </select>
                                </div>
                            </div>

                            <x-editor label="product.description" name="description" required="required">
                                {{ old('description', $product->description) }}
                            </x-editor>

                            <x-editor label="product.content" name="content">
                                {{ old('content', $product->content) }}
                            </x-editor>
                        </div>

                        <div class="tab-pane fade" id="card-toolbar-tab2">
                            <x-images :data="$images"></x-images>
                        </div>
                    </div>
                </div>

                <x-card title="action.seo" id="forms-target-left">
                    <x-multiple label="seo.meta_robots" name="meta_robots[]" :dataSelect="robot()" required="required">
                        {{ old('meta_robots', $product->meta_robots) }}
                    </x-multiple>

                    <x-multiple label="seo.meta_google_bot" name="meta_google_bot[]" :dataSelect="robot()" required="required">
                        {{ old('meta_google_bot', $product->meta_google_bot) }}
                    </x-multiple>

                    <x-text label="seo.slug" type="text" name="slug" placeholder="seo.slug" id="slug_name" required="required">
                        {{ old('slug', $product->slug) }}
                    </x-text>

                    <x-text label="seo.title_tag" type="text" name="title_tag" placeholder="seo.title_tag" id="title_name" required="required">
                        {{ old('title_tag', $product->title_tag) }}
                    </x-text>

                    <x-tag label="seo.meta_keywords" name="meta_keywords" placeholder="seo.meta_description">
                        {{ old('meta_keywords', $product->meta_keywords) }}
                    </x-tag>

                    <x-description label="seo.meta_description" name="meta_description" placeholder="seo.meta_description">
                        {{ old('meta_description', $product->meta_description) }}
                    </x-description>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card :module="$category_name" id="forms-target-right">
                    @if (count($categories) <= 0)
                        {{ message('product.no_category') }}
                    @else
                        @php
                            recursionList($categories, $category_product)
                        @endphp
                    @endif
                </x-card>

                <x-card title="action.info" id="forms-target-right">
                    <x-selectbox label="product.producer" name="producer_id" :dataSelect="$producer" required="required">
                        {{ old('producer', $product->producer) }}
                    </x-selectbox>

                    <x-text label="product.position" type="text" name="position" placeholder="product.position" required="required">
                        {{ old('position', $product->position) }}
                    </x-text>

                    <x-text label="product.viewed" type="text" name="viewed" placeholder="product.viewed" required="required">
                        {{ old('viewed', $product->viewed) }}
                    </x-text>

                    <x-selectbox label="element.open_link" name="open_link" :dataSelect="open_link()">
                        {{ old('open_link', $product->open_link) }}
                    </x-selectbox>

                    <x-selectbox label="product.template" name="template" :dataSelect="template_detail_product()">
                        {{ old('template', $product->template) }}
                    </x-selectbox>

                    <x-multiple label="element.access" name="access[]" :dataSelect="level()">
                        {{ old('access', $product->access) }}
                    </x-multiple>

                    <x-selectbox label="element.status" name="status" :dataSelect="status()">
                        {{ old('status', $product->status) }}
                    </x-selectbox>

                    <x-multiple label="element.featured" name="featured[]" :dataSelect="featured()">
                        {{ old('featured', $product->featured) }}
                    </x-multiple>

                    <x-image name="image">
                        {{ old('image', $product->image) }}
                    </x-image>

                    <x-youtube name="youtube" label="product.youtube" placeholder="product.youtube">
                        {{ old('youtube', $product->youtube) }}
                    </x-youtube>

                    <x-file label="product.file" name="file" placeholder="product.file">
                        {{ old('file', $product->file) }}
                    </x-file>
                </x-card>
            </div>
        </div>
    </form>
@endsection

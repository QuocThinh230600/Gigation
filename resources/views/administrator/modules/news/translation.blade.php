@extends('administrator.master')
@section('module', module('news'))
@section('action', behavior('action.translation'))
@section('title', title_module('news','translation'))

@canany(['news_index', 'news_edit', 'news_destroy'])
    @section('index', route('admin.news.index'))
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
    <form action="{{ route('admin.news.translation', ['news' => $news->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.news.index')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="content.locale" name="locale_origin" placeholder="content.locale" :dataSelect="$languages_current" disabled="disabled">
                        {{ old('locale_origin',$news->locale) }}
                    </x-language>

                    <x-text label="news.title" type="text" name="title_origin" placeholder="news.title">
                        {{ old('title_origin',$news->title) }}
                    </x-text>

                    <x-text label="news.author" type="text" name="author_origin" placeholder="news.author">
                        {{ old('author_origin',$news->author) }}
                    </x-text>

                    <x-text label="news.copyright" type="text" name="copyright_origin" placeholder="news.copyright">
                        {{ old('copyright_origin',$news->copyright) }}
                    </x-text>

                    <x-editor label="news.intro" name="intro_origin">
                        {{ old('intro_origin',$news->intro) }}
                    </x-editor>

                    <x-editor label="news.content" name="content_origin">
                        {{ old('content_origin',$news->content) }}
                    </x-editor>

                    <x-editor label="news.foot" name="foot_origin">
                        {{ old('foot_origin',$news->foot) }}
                    </x-editor>
                </x-card>

                <x-card title="action.info" id="forms-target-left">
                    <x-image name="image_origin">
                        {{ old('image_origin',$news->image) }}
                    </x-image>

                    <x-youtube name="youtube_origin" label="news.youtube" placeholder="news.youtube">
                        {{ old('youtube_origin',$news->youtube) }}
                    </x-youtube>

                    <x-file label="news.file" name="file_origin" placeholder="news.file">
                        {{ old('file_origin',$news->file) }}
                    </x-file>
                </x-card>

                <x-card title="action.seo" id="forms-target-left">
                    <x-multiple label="seo.meta_robots" name="meta_robots_origin[]" :dataSelect="robot()">
                        {{ old('meta_robots_origin',$news->meta_robots) }}
                    </x-multiple>

                    <x-multiple label="seo.meta_google_bot" name="meta_google_bot_origin[]" :dataSelect="robot()">
                        {{ old('meta_google_bot_origin',$news->meta_google_bot) }}
                    </x-multiple>

                    <x-text label="seo.slug" type="text" name="slug_origin" placeholder="seo.slug">
                        {{ old('slug_origin',$news->slug) }}
                    </x-text>

                    <x-text label="seo.title_tag" type="text" name="title_tag_origin" placeholder="seo.title_tag">
                        {{ old('title_tag_origin',$news->title_tag) }}
                    </x-text>

                    <x-tag label="seo.meta_keywords" name="meta_keywords_origin" placeholder="seo.meta_description">
                        {{ old('meta_keywords_origin',$news->meta_keywords) }}
                    </x-tag>

                    <x-description label="seo.meta_description" name="meta_description_origin" placeholder="seo.meta_description">
                        {{ old('meta_description_origin',$news->meta_description) }}
                    </x-description>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-language label="content.locale" name="locale" placeholder="content.locale" :dataSelect="$languages_remaining">
                        {{ old('locale') }}
                    </x-language>

                    <x-text label="news.title" type="text" name="title" placeholder="news.title" slug="slug_name" title="title_name">
                        {{ old('title') }}
                    </x-text>

                    <x-text label="news.author" type="text" name="author" placeholder="news.author">
                        {{ old('author', auth()->user()->full_name) }}
                    </x-text>

                    <x-text label="news.copyright" type="text" name="copyright" placeholder="news.copyright">
                        {{ old('copyright') }}
                    </x-text>

                    <x-editor label="news.intro" name="intro">
                        {{ old('intro') }}
                    </x-editor>

                    <x-editor label="news.content" name="content">
                        {{ old('content') }}
                    </x-editor>

                    <x-editor label="news.foot" name="foot">
                        {{ old('foot') }}
                    </x-editor>
                </x-card>

                <x-card title="action.info" id="forms-target-right">
                    <x-image name="image">
                        {{ old('image') }}
                    </x-image>

                    <x-youtube name="youtube" label="news.youtube" placeholder="news.youtube">
                        {{ old('youtube') }}
                    </x-youtube>

                    <x-file label="news.file" name="file" placeholder="news.file">
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

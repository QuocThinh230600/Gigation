@extends('administrator.master')
@section('module', module('config'))
@section('action', behavior('action.edit'))
@section('title', title_module('config','edit'))

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'media/fancybox.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/inputs/maxlength.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/tags/tokenfield.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ace.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <form action="{{ route('admin.config.update') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.config.edit')])

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="config.website_name" type="text" name="website_name" placeholder="config.website_name" required="required">
                        {{ old('website_name', $config["website_name"]) }}
                    </x-text>

                    <x-text label="config.title" type="text" name="title" placeholder="config.title" required="required">
                        {{ old('title', $config["title"]) }}
                    </x-text>

                    <x-multiple label="config.meta_robots" name="meta_robots[]" :dataSelect="robot()" required="required">
                        {{ old('meta_robots', $config["meta_robots"]) }}
                    </x-multiple>

                    <x-multiple label="config.meta_google_bot" name="meta_google_bot[]" :dataSelect="robot()" required="required">
                        {{ old('meta_google_bot', $config["meta_google_bot"]) }}
                    </x-multiple>

                    <x-tag label="config.meta_keywords" name="meta_keywords" placeholder="seo.meta_description" required="required">
                        {{ old('meta_keywords', $config["meta_keywords"]) }}
                    </x-tag>

                    <x-description label="config.meta_description" name="meta_description" placeholder="seo.meta_description" required="required">
                        {{ old('meta_description', $config["meta_description"]) }}
                    </x-description>
                </x-card>
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="config.copyright" type="text" name="copyright" placeholder="config.copyright">
                        {{ old('copyright', $config["copyright"]) }}
                    </x-text>

                    <x-text label="config.author" type="text" name="author" placeholder="config.author">
                        {{ old('author', $config["author"]) }}
                    </x-text>

                    <x-text label="config.placename" type="text" name="placename" placeholder="config.placename">
                        {{ old('placename', $config["placename"]) }}
                    </x-text>

                    <x-text label="config.region" type="text" name="region" placeholder="config.region">
                        {{ old('region', $config["region"]) }}
                    </x-text>

                    <x-text label="config.position" type="text" name="position" placeholder="config.position">
                        {{ old('position', $config["position"]) }}
                    </x-text>

                    <x-text label="config.icbm" type="text" name="icbm" placeholder="config.icbm">
                        {{ old('icbm', $config["icbm"]) }}
                    </x-text>

                    <x-text label="config.revisit_after" type="text" name="revisit_after" placeholder="config.revisit_after">
                        {{ old('revisit_after', $config["revisit_after"]) }}
                    </x-text>
                </x-card>
                <x-card title="action.info" id="forms-target-left">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <p><span class="font-weight-semibold">Chỉnh sửa</span> css</p>
                                <pre id="css_editor" data-fouc>
                                    {{$config['css']}}
                                </pre>
                                <input type="hidden" name="css">
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="col-lg-6">
                <x-card title="action.info" id="forms-target-right">
                    <x-text label="config.facebook" type="text" name="facebook" placeholder="config.facebook">
                        {{ old('icbm', $config["facebook"]) }}
                    </x-text>

                    <x-text label="config.youtube" type="text" name="youtube" placeholder="config.youtube">
                        {{ old('icbm', $config["youtube"]) }}
                    </x-text>

                    <x-text label="config.linkedin" type="text" name="linkedin" placeholder="config.linkedin">
                        {{ old('linkedin', $config["linkedin"]) }}
                    </x-text>
                </x-card>

                <x-card title="action.info" id="forms-target-right">
                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('config.google_analytics') }}</label>
                        <textarea name="google_analytics" class="form-control" placeholder="{{ placeholder('config.google_analytics') }}">{{ old('google_plus', $config["google_analytics"]) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('config.google_ads') }}</label>
                        <textarea name="google_ads" class="form-control" placeholder="{{ placeholder('config.google_ads') }}">{{ old('google_plus', $config["google_ads"]) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('config.facebook_script') }}</label>
                        <textarea name="facebook_script" class="form-control" placeholder="{{ placeholder('config.facebook_script') }}">{{ old('google_plus', $config["facebook_script"]) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-semibold">{{ label('config.chat') }}</label>
                        <textarea name="chat" class="form-control" placeholder="{{ placeholder('config.chat') }}">{{ old('google_plus', $config["chat"]) }}</textarea>
                    </div>
                </x-card>

                <x-card title="action.info" id="forms-target-right">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="font-weight-semibold">{{ label('config.logo') }}</label>
                            <x-image name="logo">
                                {{ old('logo', $config["logo"]) }}
                            </x-image>
                        </div>

                        <div class="col-lg-6">
                            <label class="font-weight-semibold">{{ label('config.favicon') }}</label>
                            <x-image name="favicon">
                                {{ old('favicon', $config["favicon"]) }}
                            </x-image>
                        </div>

                        <div class="col-lg-6">
                            <label class="font-weight-semibold">{{ label('config.contrast_logo') }}</label>
                            <x-image name="contrast_logo">
                                {{ old('contrast_logo', $config["contrast_logo"]) }}
                            </x-image>
                        </div>

                        <div class="col-lg-6">
                            <label class="font-weight-semibold">{{ label('config.error_image') }}</label>

                            <x-image name="error_image">
                                {{ old('error_image', $config["error_image"]) }}
                            </x-image>
                        </div>
                    </div>
                </x-card>
                <x-card title="action.info" id="forms-target-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <p><span class="font-weight-semibold">Chỉnh sửa</span> javascript</p>
                                <pre id="javascript_editor" data-fouc>
                                    {{$config['js']}}
                                </pre>
                            </div>
                            <input type="hidden" name="js">
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </form>
@endsection

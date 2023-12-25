@extends('administrator.master')
@section('module', module('content'))
@section('action', behavior('action.edit'))
@section('title', title_module('content','edit'))

@canany(['content_index', 'content_edit', 'content_destroy'])
    @section('index', route('admin.content.index',['page' => $page->uuid]))
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
        <span class="font-weight-semibold">{{ label('content.alert') }}</span>{{ trans('form.content.page_content', ['page' => $page->name]) }}
    </div>

    <form action="{{ route('admin.content.update',['page' => $page->uuid, 'content' => $content->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.content.index',['page' => $page->uuid])])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-editor label="content.content" name="content">
                        {{ old('content',$content->content) }}
                    </x-editor>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-toggle label="element.status" name="status" on="element.status_enable"  off="element.status_disable">
                        {{ old('status',$content->status) }}
                    </x-toggle>

                    <x-image name="image">
                        {{ old('image',$content->image) }}
                    </x-image>
                </x-card>
            </div>
        </div>
    </form>
@endsection

@extends('administrator.master')
@section('module', module('backup'))
@section('action', behavior('action.create'))
@section('title', title_module('backup','create'))

@canany(['backup_index', 'backup_destroy'])
    @section('index', route('admin.backup.index'))
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
    <form action="{{ route('admin.backup.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.backup.index')])

            <div class="col-lg-12">
                <x-card title="action.info" id="forms-target-left">
                    <x-selectbox label="backup.type" name="type" :dataSelect="backup()" required="required">
                        {{ old('type') }}
                    </x-selectbox>
                </x-card>
            </div>
        </div>
    </form>
@endsection

@extends('administrator.master')
@section('module', module('advantages'))
@section('action', behavior('action.create'))
@section('title', title_module('advantages', 'create'))

@canany(['advantages_index', 'advantages_edit', 'advantages_destroy'])
    @section('index', route('admin.advantages.index'))
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
    <form action="{{ route('admin.advantages.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.advantages.index')])

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

                    <div class="card-body tab-content" id="forms-target-left">
                        <div class="tab-pane fade show active" id="card-toolbar-tab1">
                            <x-text label="advantages.name" type="text" name="name" placeholder="advantages.name" slug="slug_name" title="title_name" required="required">
                                {{ old('name') }}
                            </x-text>

                            <x-editor label="advantages.title" name="title">
                                {{ old('title') }}
                            </x-editor>

                            <x-editor label="advantages.content" name="content">
                                {{ old('content') }}
                            </x-editor>

                            <x-editor label="advantages.subcontent" name="subcontent">
                                {{ old('subcontent') }}
                            </x-editor>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">

                    <x-selectbox label="advantages.category" name="category_id" :dataSelect="$categories" required="required">
                        {{ old('category_id') }}
                    </x-selectbox>

                    <x-text label="advantages.position" type="text" name="position" placeholder="advantages.position">
                        {{ old('position',$root_position_max) }}
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

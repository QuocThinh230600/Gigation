@extends('administrator.master')
@section('module', module('customer'))
@section('action', behavior('action.create'))
@section('title', title_module('customer', 'create'))

@canany(['customer_index', 'customer_edit', 'customer_destroy'])
    @section('index', route('admin.customer.index'))
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
    <form action="{{ route('admin.customer.update', ['customer' => $customer->uuid]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.customer.index')])
            
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
                            <x-text label="customer.name" type="text" name="name" placeholder="customer.name" slug="slug_name" title="title_name" required="required">
                                {{ old('name', $customer->name) }}
                            </x-text>

                            <x-editor label="customer.content" name="content">
                                {{ old('content', $customer->content) }}
                            </x-editor>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">

                    <x-selectbox label="element.open_link" name="open_link" :dataSelect="open_link()">
                        {{ old('open_link', $customer->open_link)}}
                    </x-selectbox>

                    <x-text label="images_position.link" type="text" name="link" placeholder="images_position.link" required="required">
                        {{ old('link', $customer->link) }}
                    </x-text>

                    <x-toggle label="element.status" name="status" on="element.status_enable"  off="element.status_disable" required="required">
                        {{ old('status', $customer->status) }}
                    </x-toggle>

                    <x-image name="image">
                        {{ old('image', $customer->image) }}
                    </x-image>
                </x-card>
            </div>
        </div>
    </form>
@endsection

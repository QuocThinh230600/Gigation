@extends('administrator.master')
@section('module', module('user'))
@section('action', behavior('action.create'))
@section('title', title_module('user', 'create'))

@canany(['user_index', 'user_edit', 'user_destroy'])
    @section('index', route('admin.user.index'))
@endcanany

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'media/fancybox.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('POST')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.user.index')])

            <div class="col-lg-8">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="user.email" type="email" name="email" placeholder="user.email" required="required">
                        {{ old('email') }}
                    </x-text>

                    <x-text label="user.password" type="password" name="password" placeholder="user.password" required="required">
                        {{ old('password') }}
                    </x-text>

                    <x-text label="user.password_confirm" type="password" name="password_confirmation" placeholder="user.password_confirm" required="required">
                        {{ old('password_confirm') }}
                    </x-text>
                </x-card>

                <x-card title="action.info" id="forms-target-left">
                    <x-text label="user.full_name" name="full_name" placeholder="user.full_name" required="required">
                        {{ old('full_name') }}
                    </x-text>

                    <x-text label="user.phone" name="phone" placeholder="user.phone" required="required">
                        {{ old('phone') }}
                    </x-text>

                    <x-text label="user.address" name="address" placeholder="user.address" required="required">
                        {{ old('address') }}
                    </x-text>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="action.info" id="forms-target-right">
                    <x-selectbox label="user.level" name="level" :dataSelect="level()" required="required">
                        {{ old('level') }}
                    </x-selectbox>

                    <div id="user_role">
                        <x-selectbox label="user.permission" name="role_id" :dataSelect="$roles" required="required">
                            {{ old('role_id') }}
                        </x-selectbox>
                    </div>

                    <x-image name="avatar">
                        {{ old('avatar') }}
                    </x-image>

                    <x-toggle label="element.status" name="status" on="element.status_enable" off="element.status_disable" required="required">
                        {{ old('status','on') }}
                    </x-toggle>
                </x-card>
            </div>
        </div>
    </form>
@endsection

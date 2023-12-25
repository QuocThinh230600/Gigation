@extends('administrator.master')
@section('module', module('myself'))
@section('action', behavior('action.index'))
@section('title', title_module('myself', 'index'))

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <div class="d-md-flex align-items-md-start">

        <!-- Left sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Navigation -->
                <div class="card">
                    <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url({{ asset(GLOBAL_ASSETS_IMG.'backgrounds/panel_bg.png') }}); background-size: contain;">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" id="avatar" src="{{ $user->avatar ?? asset(GLOBAL_ASSETS_IMG . 'avatar.svg') }}" width="170" height="170" alt="">
                            <input type="hidden" name="avatar" id="avatar" value="{{ $user->avatar }}" />
                            <input type="hidden" id="ajax_avatar" value="{{ route('admin.personal.update_avatar') }}" />
                            <div class="card-img-actions-overlay rounded-circle">
                                <a href="#" id="avatar" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round upload-image">
                                    <i class="icon-plus3"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold mb-0">{{ $user->full_name ?? $user->email }}</h6>

                        <span class="d-block opacity-75">
                            @if ($user->id == 1)
                                Super Administrator
                            @elseif ($user->level == 1)
                                Administrator
                            @else
                                Member
                            @endif
                        </span>

                        <div class="list-icons list-icons-extended mt-3">
                            <a href="#" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Google Drive"><i class="icon-google-drive"></i></a>
                            <a href="#" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Twitter"><i class="icon-facebook"></i></a>
                            <a href="#" class="list-icons-item text-white" data-popup="tooltip" title="" data-container="body" data-original-title="Github"><i class="icon-youtube"></i></a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-sidebar mb-2">
                            <li class="nav-item-header">Navigation</li>
                            <li class="nav-item">
                                <a href="#profile" class="nav-link active" data-toggle="tab">
                                    <i class="icon-user"></i>
                                    {{ label('personal.my_profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#schedule" class="nav-link" data-toggle="tab">
                                    <i class="icon-calendar3"></i>
                                    {{ label('personal.login_history') }}
                                </a>
                            </li>
                            <li class="nav-item-divider"></li>
                            <li class="nav-item">
                                <a href="{{ route('auth.logout') }}" class="nav-link" data-toggle="tab">
                                    <i class="icon-switch2"></i>
                                    {{ label('personal.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /navigation -->
            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /left sidebar component -->


        <!-- Right content -->
        <div class="tab-content w-100">
            <div class="tab-pane fade active show" id="profile">

                <!-- Account settings -->
                <form action="{{ route('admin.personal.update_account') }}" method="POST" class="formAjax">
                    @csrf
                    @method('PUT')

                    <x-card title="action.info" id="forms-target-left">
                        <x-text label="personal.email" type="email" name="email" placeholder="personal.email" disabled="disabled">
                            {{ old('email',$user->email) }}
                        </x-text>

                        <x-text label="personal.current_password" type="password" name="current_password" placeholder="personal.current_password">
                            {{ old('current_password') }}
                        </x-text>

                        <x-text label="personal.new_password" type="password" name="password" placeholder="personal.new_password">
                            {{ old('password') }}
                        </x-text>

                        <x-text label="personal.new_password_confirm" type="password" name="password_confirmation" placeholder="personal.new_password_confirm">
                            {{ old('password_confirm') }}
                        </x-text>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ label('personal.save_change') }}</button>
                        </div>

                    </x-card>
                </form>
                <!-- /account settings -->

                <!-- Profile info -->
                <form action="{{ route('admin.personal.update_info') }}" method="POST" class="formAjax">
                    @csrf
                    @method('PUT')
                    <x-card title="action.info" id="forms-target-left">
                        <x-text label="personal.full_name" name="full_name" placeholder="personal.fullname">
                            {{ old('fullname',$user->full_name) }}
                        </x-text>

                        <x-text label="personal.phone" name="phone" placeholder="personal.phone">
                            {{ old('phone',$user->phone) }}
                        </x-text>

                        <x-text label="personal.address" name="address" placeholder="personal.address">
                            {{ old('address',$user->address) }}
                        </x-text>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ label('personal.save_change') }}</button>
                        </div>
                    </x-card>
                </form>
                <!-- /profile info -->
            </div>

            <div class="tab-pane fade" id="schedule">
                <x-card title="action.info" table="true" id="forms-target-left">
                    <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.personalDataTables') }}">
                        <thead>
                            <tr>
                                <th>{{ label('personal.login_at') }}</th>
                                <th>{{ label('personal.login_ip') }}</th>
                                <th>{{ label('personal.device') }}</th>
                                <th>{{ label('personal.os') }}</th>
                                <th>{{ label('personal.browser') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th type="text" data="login_at" name="login_at">{{ label('personal.login_at') }}</th>
                                <th type="text" data="login_ip" name="login_ip">{{ label('personal.login_ip') }}</th>
                                <th type="text" data="device" name="device">{{ label('personal.device') }}</th>
                                <th type="text" data="os" name="os">{{ label('personal.os') }}</th>
                                <th type="text" data="browser" name="browser">{{ label('personal.browser') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </x-card>
            </div>

            <div class="tab-pane fade" id="inbox">
                <x-card title="action.info" id="forms-target-left">

                </x-card>
            </div>

            <div class="tab-pane fade" id="orders">
                <x-card title="action.info" id="forms-target-left">

                </x-card>
            </div>
        </div>
        <!-- /right content -->

    </div>
@endsection

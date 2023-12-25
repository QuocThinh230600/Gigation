@extends('administrator.master')
@section('module', module('role'))
@section('action', behavior('action.edit'))
@section('title', title_module('role', 'edit'))

@canany(['role_index', 'role_edit', 'role_destroy'])
    @section('index', route('admin.role.index'))
@endcanany

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'ui/dragula.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'editors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    @include('ckfinder::setup')
@endpush

@section('content')
    <form action="{{ route('admin.role.update', ['role' => $role->id]) }}" method="POST" enctype="multipart/form-data" class="formAjax">
        @csrf
        @method('PUT')

        <div class="row">
            @include('administrator.partials.button', ['exit' => route('admin.role.index')])

            <div class="col-lg-12">
                <x-card title="action.info" id="forms-target-left">
                    <x-text label="role.name" name="name" placeholder="role.name" required="required">
                        {{ old('name', $role->name) }}
                    </x-text>

                    <x-editor label="role.description" name="description">
                        {{ old('description', $role->description) }}
                    </x-editor>

                    <x-toggle label="element.status" name="status" on="element.status_enable"  off="element.status_disable" required="required">
                        {{ old('status', $role->status) }}
                    </x-toggle>
                </x-card>
            </div>

            <div class="col-lg-12 mb-3">
                <div class="toast" style="opacity: 1; max-width: none;">
                    <div class="toast-body">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="check-all-permission" class="form-check-input-styled permission"/> {{ label('role.all_permission') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Generate role permission of module --}}
            @foreach (role_permissions() as $module => $permissions)
                <div class="col-lg-4">
                    <x-card :module="$module" id="forms-target-left">
                        <ul class="list-permission-parent">
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="chkManage" class="form-check-input-styled permission" /> {{ label('role.permission_manage') }}
                                    </label>
                                </div>
                                <ul class="list-permission-child">
                                    @foreach ($permissions as $permission)
                                        <li>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permission[]" class="form-check-input-styled permission" value="{{ $permission['value'] }}" {{ checkedRole (old('permission', $permission_edit), $permission['value']) }} /> {{ $permission['name'] }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </x-card>
                </div>
            @endforeach
            {{-- ! End generate role permission of module --}}

        </div>
    </form>
@endsection

@extends('administrator.master')
@section('module', module('user'))
@section('action', behavior('action.index'))
@section('title', title_module('user','index'))

@can('user_create')
    @section('create', route('admin.user.create'))
@endcan

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
@endpush

@section('content')
    <x-card title="action.info" table="true">
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.userDataTables') }}">
            <thead>
                <tr>
                    <th>{{ label('user.avatar') }}</th>
                    <th>{{ label('user.email') }}</th>
                    <th>{{ label('user.full_name') }}</th>
                    <th>{{ label('user.level') }}</th>
                    <th>{{ label('element.status') }}</th>
                    @canany(['user_edit', 'user_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="avatar" name="avatar">{{ label('user.avatar') }}</th>
                    <th type="text" data="email" name="email">{{ label('user.email') }}</th>
                    <th type="text" data="full_name" name="full_name">{{ label('user.full_name') }}</th>
                    <th type="select" data="level" name="level">
                        <select class="form-control filter-select">
                            <option value="">{{ label('please_choose') }}</option>
                            @foreach (level() as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th type="select" data="status" name="status">
                        <select class="form-control filter-select">
                            <option value="">{{ label('please_choose') }}</option>
                            <option value="on">{{ label('element.status_enable') }}</option>
                            <option value="off">{{ label('element.status_disable') }}</option>
                        </select>
                    </th>
                    @canany(['user_edit', 'user_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

@extends('administrator.master')
@section('module', module('ward'))
@section('action', behavior('action.index'))
@section('title', title_module('ward', 'index'))

@can('ward_create')
    @section('create', route('admin.ward.create'))
@endcan

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/noty.min.js') }}"></script>
@endpush

@section('content')
    <x-card title="action.info" table="true">
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.wardDataTables') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('province.name') }}</th>
                    <th>{{ label('district.name') }}</th>
                    <th>{{ label('ward.name') }}</th>
                    <th>{{ label('element.status') }}</th>
                    @canany(['ward_edit', 'ward_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th name="DT_RowIndex" data="DT_RowIndex" orderable="false" searchable="false"></th>
                    <th type="text" data="pname" name="provinces.name">{{ label('province.name') }}</th>
                    <th type="text" data="dname" name="districts.name">{{ label('district.name') }}</th>
                    <th type="text" data="wname" name="wards.name">{{ label('ward.name') }}</th>
                    <th type="select" data="wstatus" name="wards.status">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            <option value="on">{{ label('element.status_enable') }}</option>
                            <option value="off">{{ label('element.status_disable') }}</option>
                        </select>
                    </th>
                    @canany(['ward_edit', 'ward_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

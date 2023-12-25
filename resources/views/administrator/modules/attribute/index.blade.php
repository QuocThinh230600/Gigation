@extends('administrator.master')
@section('module', module('attribute'))
@section('action', behavior('action.index'))
@section('title', title_module('attribute','index'))

@can('attribute_create')
    @section('create', route('admin.attribute.create'))
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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.attributeDataTables') }}">
            <thead>
            <tr>
                <th>{{ label('element.table_id') }}</th>
                <th>{{ label('attribute.name') }}</th>
                <th>{{ label('attribute.parent') }}</th>
                <th>{{ label('element.status') }}</th>
                @canany(['attribute_edit', 'attribute_destroy'])
                    <th class="text-center">{{ label('element.actions') }}</th>
                @endcanany
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                <th type="text" data="name" name="name">{{ label('attribute.name') }}</th>
                <th type="text" data="parent" name="parent">{{ label('attribute.parent') }}</th>
                <th type="select" data="status" name="status">
                    <select class="form-control">
                        <option value="">{{ label('please_choose') }}</option>
                        <option value="on">{{ label('element.status_enable') }}</option>
                        <option value="off">{{ label('element.status_disable') }}</option>
                    </select>
                </th>
                @canany(['attribute_edit', 'attribute_destroy'])
                    <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                @endcanany
            </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

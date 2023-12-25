@extends('administrator.master')
@section('module', module('language'))
@section('action', behavior('action.index'))
@section('title', title_module('language', 'index'))

@can('language_create')
    @section('create', route('admin.language.create'))
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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.languageDataTables') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('language.name') }}</th>
                    <th>{{ label('language.flag') }}</th>
                    <th>{{ label('language.default') }}</th>
                    <th>{{ label('language.status') }}</th>
                    @canany(['language_edit', 'language_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                    <th type="text" data="name" name="name">{{ label('language.name') }} ({{ label('language.locale') }})</th>
                    <th data="flag" name="flag" orderable="false" searchable="false"></th>
                    <th type="select" data="default" name="default">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            <option value="on">{{ label('element.default_yes') }}</option>
                            <option value="off">{{ label('element.default_no') }}</option>
                        </select>
                    </th>
                    <th type="select" data="status" name="status">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            <option value="on">{{ label('element.status_enable') }}</option>
                            <option value="off">{{ label('element.status_disable') }}</option>
                        </select>
                    </th>
                    @canany(['language_edit', 'language_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

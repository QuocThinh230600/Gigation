@extends('administrator.master')
@section('module', module('advantages'))
@section('action', behavior('action.index'))
@section('title', title_module('advantages', 'index'))

@can('advantages_create')
    @section('create', route('admin.advantages.create'))
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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.advantagesDataTable') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('advantages.name') }}</th>
                    <th>{{ label('advantages.title') }}</th>
                    <th>{{ label('advantages.category') }}</th>
                    <th>{{ label('element.status') }}</th>
                    @canany(['advantages_edit', 'advantages_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                    <th type="text" data="name" name="name">{{ label('advantages.name') }}</th>
                    <th type="text" data="title" name="title">{{ label('advantages.title') }}</th>
                    <th type="select" data="category_id" name="category_id">
                        <select class="form-control" name="category">
                            <option value="">{{ label('please_choose') }}</option>
                            @php
                                recursiveSelectDatatable($category, old('category_id'))
                            @endphp
                        </select>
                    </th>
                    <th type="select" data="status" name="status">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            <option value="on">{{ label('element.status_enable') }}</option>
                            <option value="off">{{ label('element.status_disable') }}</option>
                        </select>
                    </th>
                    @canany(['advantages_edit', 'advantages_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

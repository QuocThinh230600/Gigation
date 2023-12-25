@extends('administrator.master')
@section('module', module('activity'))
@section('action', behavior('action.index'))
@section('title', title_module('activity','index'))

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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.activityDataTables') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('activity.module') }}</th>
                    <th>{{ label('activity.action') }}</th>
                    <th>{{ label('activity.description') }}</th>
                    <th>{{ label('activity.method') }}</th>
                    <th>{{ label('activity.ip') }}</th>
                    <th>{{ label('element.created_at') }}</th>
                    @canany(['activity_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                    <th type="text" data="module" name="module">{{ label('activity.module') }}</th>
                    <th type="text" data="action" name="action">{{ label('activity.action') }}</th>
                    <th type="text" data="description" name="description">{{ label('activity.description') }}</th>
                    <th type="text" data="method" name="method">{{ label('activity.method') }}</th>
                    <th type="text" data="ip" name="ip">{{ label('activity.ip') }}</th>
                    <th data="created_at" name="created_at">{{ label('element.created_at') }}</th>
                    @canany(['activity_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

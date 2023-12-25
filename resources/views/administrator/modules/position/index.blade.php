@extends('administrator.master')
@section('module', module('position'))
@section('action', behavior('action.index'))
@section('title', title_module('position', 'index'))

@can('category_create')
    @section('create', route('admin.position.create'))
@endcan

@push('themejs')
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/switch.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
@endpush

@section('content')
    <div id="table-content">
        <x-card title="action.info" table="true">
            <table class="table table-hover" data-url="{{ route('admin.ajax.ajaxTablePosition') }}">
                <thead>
                    <tr>
                        <th>{{ label('element.table_id') }}</th>
                        <th>{{ label('position.name') }}</th>
                        <th>{{ label('element.created_at') }}</th>
                        <th>{{ label('element.status') }}</th>
                        @canany(['position_edit', 'position_destroy'])
                            <th class="text-center">{{ label('element.actions') }}</th>
                        @endcanany
                    </tr>
                </thead>

                <tbody>
                @if (count($positions) <= 0)
                    <tr>
                        <td colspan="5" class="text-center">{{ message('crud.table_no_record') }}</td>
                    </tr>
                @else
                    @php
                        recursiveTable($positions)
                    @endphp
                @endif
                </tbody>

                <tfoot>
                    <tr>
                        <th>{{ label('element.table_id') }}</th>
                        <th>{{ label('position.name') }}</th>
                        <th>{{ label('element.created_at') }}</th>
                        <th>{{ label('element.status') }}</th>
                        @canany(['position_edit', 'position_destroy'])
                            <th class="text-center">{{ label('element.actions') }}</th>
                        @endcanany
                    </tr>
                </tfoot>
            </table>
        </x-card>
    </div>
@endsection

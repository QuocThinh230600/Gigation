@extends('administrator.master')
@section('module', module('contact'))
@section('action', behavior('action.index'))
@section('title', title_module('contact','index'))

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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.contactDataTables') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('contact.full_name') }}</th>
                    <th>{{ label('contact.phone') }}</th>
                    <th>{{ label('contact.email') }}</th>
                    <th>{{ label('contact.message') }}</th>
                    <th>{{ label('element.status') }}</th>
                    @canany(['contact_reply', 'contact_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                    <th type="text" data="full_name" name="full_name">{{ label('contact.full_name') }}</th>
                    <th type="text" data="phone" name="phone">{{ label('contact.phone') }}</th>
                    <th type="text" data="email" name="email">{{ label('contact.email') }}</th>
                    <th data="message" name="message">{{ label('contact.message') }}</th>
                    <th type="select" data="status" name="status">
                        <select class="form-control filter-select">
                            <option value="">{{ label('please_choose') }}</option>
                            @foreach (status_contact() as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </th>
                    @canany(['contact_reply', 'contact_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

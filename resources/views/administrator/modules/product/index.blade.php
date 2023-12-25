@extends('administrator.master')
@section('module', module('product'))
@section('action', behavior('action.index'))
@section('title', title_module('product','index'))

@can('product_create')
    @section('create',route('admin.product.create'))
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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.productDataTables') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    {{-- <th>{{ label('product.image') }}</th> --}}
                    <th>{{ label('product.name') }}</th>
                    <th>{{ label('product.category') }}</th>
                    <th>{{ label('element.status') }}</th>
                    <th>{{ label('element.featured') }}</th>
                    @canany(['product_edit', 'product_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                    {{-- <th data="image" name="image"></th> --}}
                    <th type="text" data="name" name="name">{{ label('product.name') }}</th>
                    <th type="select" data="category" name="category">
                        <select class="form-control" name="category">
                            <option value="">{{ label('please_choose') }}</option>
                            @php
                                recursiveSelectDatatable($category, old('category'))
                            @endphp
                        </select>
                    </th>
                    <th type="select" data="status" name="status">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            @foreach (status() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th type="select" data="featured" name="featured">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            @foreach (featured() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </th>
                    @canany(['product_edit', 'product_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

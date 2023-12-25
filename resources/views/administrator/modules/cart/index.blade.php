@extends('administrator.master')
@section('module', module('cart'))
@section('action', behavior('action.index'))
@section('title', title_module('cart','index'))

@can('cart_create')
    @section('create',route('admin.cart.create'))
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
        <table class="table table-hover datatable-colvis-basic" url="{{ route('admin.ajax.CartController') }}">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('cart.full_name') }}</th>
                    <th>{{ label('cart.phone') }}</th>
                    <th>{{ label('cart.email') }}</th>
                    <th>{{ label('cart.address') }}</th>
                    <th>{{ label('cart.note') }}</th>
                    <th>{{ label('cart.price') }}</th>
                    <th>{{ label('cart.status') }}</th>
                    @canany(['cart_edit', 'cart_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th data="DT_RowIndex" name="DT_RowIndex" orderable="false" searchable="false"></th>
                    <th type="text" data="full_name" name="full_name">{{ label('cart.full_name') }}</th>
                    <th type="text" data="phone" name="phone">{{ label('cart.phone') }}</th>
                    <th type="text" data="email" name="email">{{ label('cart.email') }}</th>
                    <th type="text" data="address" name="address">{{ label('cart.address') }}</th>
                    <th type="text" data="note" name="note">{{ label('cart.note') }}</th>
                    <th type="text" data="price" name="price">{{ label('cart.price') }}</th>
                    <th type="select" data="status" name="status">
                        <select class="form-control">
                            <option value="">{{ label('please_choose') }}</option>
                            @foreach (status_cart() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </th>
                    @canany(['cart_edit', 'cart_destroy'])
                        <th class="text-center" data="actions" name="actions" orderable="false" searchable="false">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

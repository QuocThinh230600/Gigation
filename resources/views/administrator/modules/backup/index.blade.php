@extends('administrator.master')
@section('module', module('backup'))
@section('action', behavior('action.index'))
@section('title', title_module('backup','index'))

@canany(['backup_index', 'backup_destroy'])
    @section('create', route('admin.backup.create'))
@endcanany

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
        <table class="table table-hover datatable-basic">
            <thead>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('backup.type') }}</th>
                    <th>{{ label('backup.filename') }}</th>
                    <th>{{ label('backup.filesize') }}</th>
                    <th>{{ label('element.created_at') }}</th>
                    @canany(['backup_download', 'backup_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
            @foreach ($backups as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @php
                            $filename_part = explode("-", $item["file_name"]);

                        @endphp

                        @if ($filename_part[0] == "database")
                            {{ label('backup.database') }}
                        @elseif ($filename_part[0] == "source")
                            {{ label('backup.source') }}
                        @else
                            {{ label('backup.all') }}
                        @endif
                    </td>
                    <td>{{ $item["file_name"] }}</td>
                    <td>{{ humanFilesize($item["file_size"]) }}</td>
                    <td>{{ date('d/m/Y - h:m:i',$item["last_modified"]) }}</td>
                    @canany(['backup_download', 'backup_destroy'])
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @can('backup_download')
                                            <a href="{{ route('admin.backup.download',['backup' => $item["file_name"]]) }}" class="dropdown-item"><i class="icon-download"></i> {{ behavior('action.download') }}</a>
                                        @endcan

                                        @can('backup_destroy')
                                            <a href="{{ route('admin.backup.destroy',['backup' => $item["file_name"]]) }}" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> {{ behavior('action.delete') }}</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endcanany
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>{{ label('element.table_id') }}</th>
                    <th>{{ label('backup.filename') }}</th>
                    <th>{{ label('backup.filesize') }}</th>
                    <th>{{ label('element.created_at') }}</th>
                    @canany(['backup_download', 'backup_destroy'])
                        <th class="text-center">{{ label('element.actions') }}</th>
                    @endcanany
                </tr>
            </tfoot>
        </table>
    </x-card>
@endsection

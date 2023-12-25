@extends('administrator.master')
@section('module', module('log_error'))
@section('action', behavior('action.check'))
@section('title', title_module('log_error','check'))

@push('themecss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endpush

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
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-header bg-transparent border-bottom header-elements-inline">
                    <h6 class="card-title">@lang('Levels')</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="fullscreen"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-flush log-menu">
                    @foreach($log->menu() as $levelKey => $item)
                        <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                            <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                            <span class="badge badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card mb-4">
                <div class="card-header bg-transparent border-bottom header-elements-inline">
                    <h6 class="card-title">{{ label('log_error.log_info') }} :</h6>
                    <div class="group-btns pull-right">
                        <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                            <i class="fa fa-download"></i> {{ label('log_error.download') }}
                        </a>
                        <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-toggle="modal">
                            <i class="fa fa-trash-o"></i> {{ label('log_error.delete') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-condensed mb-0">
                        <tbody>
                            <tr>
                                <td>{{ label('log_error.file_path') }} :</td>
                                <td colspan="5">{{ $log->getPath() }}</td>
                            </tr>
                            <tr>
                                <td>{{ label('log_error.log_entries') }} :</td>
                                <td>
                                    <span class="badge badge-primary">{{ $entries->total() }}</span>
                                </td>
                                <td>{{ label('log_error.size') }} :</td>
                                <td>
                                    <span class="badge badge-primary">{{ $log->size() }}</span>
                                </td>
                                <td>{{ label('log_error.created_at') }} :</td>
                                <td>
                                    <span class="badge badge-primary">{{ $log->createdAt() }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- Search --}}
                    <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
                        <div class="form-group">
                            <div class="input-group">
                                <input id="query" name="query" class="form-control" value="{{ $query }}" placeholder="@lang('Type here to search')">
                                <div class="input-group-append">
                                    @unless (is_null($query))
                                        <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn btn-secondary">
                                            (@lang(':count results', ['count' => $entries->count()])) <i class="fa fa-fw fa-times"></i>
                                        </a>
                                    @endunless
                                    <button id="search-btn" class="btn btn-primary">
                                        <span class="fa fa-fw fa-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Log Entries --}}
            <div class="card mb-4">
                @if ($entries->hasPages())
                    <div class="card-header">
                        <span class="badge badge-info float-right">
                            {{ __('Page :current of :last', ['current' => $entries->currentPage(), 'last' => $entries->lastPage()]) }}
                        </span>
                    </div>
                @endif
            </div>

            {!! $entries->appends(compact('query'))->render() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <x-card title="action.info" table="true">
                <div class="table-responsive">
                    <table class="table table-hover datatable-basic">
                        <thead>
                            <tr>
                                <th>{{ label('log_error.env') }}</th>
                                <th style="width: 120px;">{{ label('log_error.level') }}</th>
                                <th style="width: 65px;">{{ label('log_error.time') }}</th>
                                <th>{{ label('log_error.header') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entries as $key => $entry)
                                <tr>
                                    <td>
                                        <span class="badge badge-env">{{ $entry->env }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-level-{{ $entry->level }}">
                                            {!! $entry->level() !!}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ $entry->datetime->format('H:i:s') }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $entry->header }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="{{ $log->date }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Delete log file')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you sure you want to delete this log file: :date ?', ['date' => $log->date])</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="@lang('Loading')&hellip;">@lang('Delete')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            @unless (empty(log_styler()->toHighlight()))
            @php
                $htmlHighlight = version_compare(PHP_VERSION, '7.4.0') >= 0
                    ? join('|', log_styler()->toHighlight())
                    : join(log_styler()->toHighlight(), '|');
            @endphp

            $('.stack-content').each(function() {
                var $this = $(this);
                var html = $this.html().trim()
                    .replace(/({!! $htmlHighlight !!})/gm, '<strong>$1</strong>');

                $this.html(html);
            });
            @endunless
        });
    </script>
@endsection
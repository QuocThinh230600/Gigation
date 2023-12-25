@extends('administrator.master')
@section('module', module('dashboard'))
@section('action', behavior('action.index'))
@section('title', title_module('dashboard','index'))

@push('themejs')
    @if (env('ANALYTICS_VIEW_ID') != NULL)
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'visualization/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'maps/jvectormap/jvectormap.min.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'maps/jvectormap/map_files/world.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'maps/jvectormap/map_files/countries/usa.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'maps/jvectormap/map_files/countries/germany.js') }}"></script>
    <script src="{{ asset(GLOBAL_ASSETS_PLUG.'maps/jvectormap/gdp_data.js') }}"></script>
    <script src="{{ asset(ASSETS_JS.'statistical.js') }}"></script>
    @endif
@endpush

@section('content')
    @if (env('ANALYTICS_VIEW_ID') == NULL)
        <div class="row font-weight text-center">
            <div class="col-lg-12 my-auto">
                <h1>Welcome to {{ env('APP_NAME') }}</h1>
                <h5>Copyright by Vũ Quốc Tuấn</h5>
            </div>
        </div>
    @else
    <div class="row">
        <div class="col-lg-12">
            <x-card title="action.info" id="forms-target-left">
                <div class="chart has-fixed-height" id="columns_basic" data-date="{{ $totalVisitorsDate }}" data-page="{{ $totalPageViewes }}" data-visitor="{{ $totalVisitors }}"></div>
            </x-card>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <x-card title="action.info" id="forms-target-left">
                <div class="map-container map-choropleth" id="map-national" data-nation="{{ $nation }}"></div>
            </x-card>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <x-card title="action.info" id="forms-target-left">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="pie_basic" data-topbrowser="{{ $topBrowser }}" data-browser="{{ $browser }}"></div>
                </div>
            </x-card>
        </div>

        <div class="col-lg-6">
            <x-card title="action.info" id="forms-target-left">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="pie_donut" data-visitedpages="{{ $visitedPages }}" data-type="{{ $type }}"></div>
                </div>
            </x-card>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <x-card title="action.info" id="forms-target-left" table="true">
                <table class="table table-hover datatable-basic">
                    <thead>
                        <tr>
                            <th>{{ label('dashboard.title') }}</th>
                            <th>{{ label('dashboard.viewed') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mostVisitedPages as $item)
                        <tr>
                            <td><a href="{{ $item["url"] }}">{{ Str::limit($item["pageTitle"],50) }}</a></td>
                            <td>{{ $item["pageViews"] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ label('dashboard.title') }}</th>
                            <th>{{ label('dashboard.viewed') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </x-card>
        </div>

        <div class="col-lg-6">
            <x-card title="action.info" id="forms-target-right" table="true">
                <table class="table table-hover datatable-basic">
                    <thead>
                    <tr>
                        <th>{{ label('dashboard.title') }}</th>
                        <th>{{ label('dashboard.viewed') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($peferrersData as $item)
                        <tr>
                            <td><a href="{{ $item["url"] }}">{{ $item["url"] }}</a></td>
                            <td>{{ $item["pageViews"] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>{{ label('dashboard.title') }}</th>
                        <th>{{ label('dashboard.viewed') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </x-card>
        </div>
    </div>
    @endif
@endsection

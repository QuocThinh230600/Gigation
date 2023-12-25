@extends('administrator.master')
@section('module', module('log_error'))
@section('action', behavior('action.statistical'))
@section('title', title_module('log_error','statistical'))

@push('themecss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endpush

@push('themejs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
@endpush

@section('content')
    <x-card title="action.info" id="forms-target-left">
        <div class="row">

            @if (empty($percents))
                Không có lỗi xuất hiện trong hệ thống
            @else
                <div class="col-md-6 col-lg-3">
                    <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
                </div>

                <div class="col-md-6 col-lg-9">
                    <div class="row">
                        @foreach($percents as $level => $item)
                            <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                                <div class="box level-{{ $level }}">
                                    <div class="box-icon">
                                        {!! log_styler()->icon($level) !!}
                                    </div>

                                    <div class="box-content">
                                        <span class="box-text">{{ $item['name'] }}</span>
                                        <span class="box-number">
                                            {{ $item['count'] }} @lang('entries') - {!! $item['percent'] !!} %
                                        </span>
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </x-card>

    <div class="data-chart d-none">
        {!! $chartData !!}
    </div>
@endsection


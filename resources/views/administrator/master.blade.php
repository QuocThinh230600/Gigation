<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('administrator.partials.head')
</head>
<body class="sidebar-xs">

<!-- Main navbar -->
@include('administrator.partials.main_navbar')
<!-- /main navbar -->

<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    @include('administrator.partials.main_sidebar')
    <!-- /main sidebar -->

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        @include('administrator.partials.page_header')
        <!-- /page header -->

        <!-- Content area -->
        <div class="content pt-0">
            @include('administrator.partials.alert')
            @yield('content')
        </div>
        <!-- /content area -->

        <!-- Footer -->
        @include('administrator.partials.footer')
        <!-- /footer -->
        <input type="hidden" name="pusher_key_hidden" value="{{ env('PUSHER_APP_KEY') }}" data-url="{{route('admin.ajax.addNotification')}}">
    </div>
    <!-- /main content -->

</div>
    <!-- /page content -->
</body>
</html>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>

<!-- Global stylesheets -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{ asset(GLOBAL_ASSETS_CSS.'icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'layout.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'components.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'colors.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'custom.css') }}" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Theme Plugin CSS files -->
@stack('themecss')
<!-- Theme Plugin CSS files -->

<!-- Core JS files -->
<script src="{{ asset(GLOBAL_ASSETS_JS.'main/jquery.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_JS.'main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_JS.'plugins/loaders/blockui.min.js') }}"></script>
<!-- /core JS files -->

@php
    $domain = (env("APP_URL") == 'http://localhost') ? 'http://localhost:8000' : env("APP_URL");
@endphp

<script type="text/javascript">
    let domainPath = '{{ $domain }}',
        ckEditorPath = '{{ $domain }}{{ GLOBAL_ASSETS_PLUG }}editors/ckeditor/',
        ckFinderPath = '{{ route('ckfinder_browser') }}';
</script>

<!-- Theme Plugin JS files -->
@stack('themejs')
<!-- Theme Plugin JS files -->

<!-- Theme JS files -->
<script src="{{ asset(ASSETS_JS.'app.js') }}"></script>

@if (file_exists(public_path().LANG_PATH.app()->getLocale().'.js'))
    <script src="{{ asset(LANG_PATH.app()->getLocale().'.js') }}"></script>
@else
    <script src="{{ asset(LANG_PATH.'vi.js') }}"></script>
@endif

<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script src="{{ asset(ASSETS_JS.'custom.js') }}"></script>
<script src="{{ asset(ASSETS_JS.'ajax.js') }}"></script>
<!-- /theme JS files -->

<!-- Page JS files -->
@stack('pagejs')
<!-- Page JS files -->

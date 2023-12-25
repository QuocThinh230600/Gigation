<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title', 'Sam CMS')</title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{ asset(GLOBAL_ASSETS_CSS.'icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'layout.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'components.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset(ASSETS_CSS.'colors.min.css') }}" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="{{ asset(GLOBAL_ASSETS_JS.'main/jquery.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_JS.'main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_JS.'plugins/loaders/blockui.min.js') }}"></script>

<!-- /core JS files -->

<!-- Theme Plugin JS files -->
@stack('themejs')
<!-- Theme Plugin JS files -->

<!-- Theme JS files -->
<script src="{{ asset(GLOBAL_ASSETS_PLUG.'forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/bootbox.min.js') }}"></script>
<script src="{{ asset(ASSETS_JS.'app.js') }}"></script>
<script src="{{ asset(ASSETS_JS.'auth.js') }}"></script>
<script src="{{ asset(LANG_PATH.app()->getLocale().'.js') }}"></script>
<!-- /theme JS files -->

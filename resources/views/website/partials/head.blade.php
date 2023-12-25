@php
    $route = Route::currentRouteName();
    $metas = null;

    if($route == 'new_detail' || $route == 'category' || $route == 'newtype') {
        $metas = $page_detail;
    }  else {
        $metas = $meta;
    }
@endphp

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="icon" href="{{$config["favicon"]}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@if ($route == 'website.index')
    <title>Gigaton</title>
@else
    <title>Gigaton - {{ $metas['name'] ?? $metas['title'] }}</title>
@endif

<meta name="title" content="" />
<meta name="description" content="{{ $metas->meta_description ?? $metas['meta_description'] }}" />
<meta property="og:locale" content="vi" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Gigation - {{  $metas['name'] ?? $metas['title'] }}" />
<meta property="og:description" content="{{ $metas->meta_description ?? $metas['meta_description'] }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="Gigation - {{  $metas['name'] ?? $metas['title'] }}" />
<meta property="og:image" content="{{ $metas->image ?? $metas['image'] }}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="{{asset('website/dest/style.min.css')}}">
<link rel="stylesheet" href="{{asset('website/dest/fonts.css')}}">
<link rel="stylesheet" href="{{asset('website/dest/stylelibs.min.css')}}">

@stack('themejs')

<script src="{{ asset(ASSETS_JS.'auth.js') }}"></script>

{{-- <script src="{{ asset(GLOBAL_ASSETS_JS.'main/jquery.min.js') }}"></script>
<script src="{{ asset(ASSETS_JS.'ajax.js') }}"></script> --}}

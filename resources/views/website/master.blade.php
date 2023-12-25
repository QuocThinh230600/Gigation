<!DOCTYPE html>
<html>

<head>
    {{ $config['google_analytics']}}
    {{ $config['google_ads']}}

    @include('website.partials.head')

    <style>
        {!! strip_tags($config["css"]) !!}
    </style>
    
    <script>
        {!! strip_tags($config["js"]) !!}
    </script>
</head>

<body>
    {!! $config['facebook_script']!!}
    {!! $config['chat'] !!}

    <div class="overlay"></div>
    @include('website.partials.nav_menu_mobile')
    <header>
        @include('website.partials.header')
    </header>

    @yield('content')

    <footer>
        @include('website.partials.contact_footer')
    
        @include('website.partials.main_footer')
    
        @include('website.partials.footer_location')
    
        @include('website.partials.footer_bottom')
    </footer>
    @include('website.partials.script_footer')
</body>


@include('website.partials.float_button')

</html>

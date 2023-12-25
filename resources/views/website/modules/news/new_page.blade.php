<!DOCTYPE html>
<html>

<head>
    @include('website.partials.head')
</head>

<body> 
    <div class="overlay"></div>
    @include('website.partials.new_mobile_nav')
    <header class="header-news">
        @include('website.partials.header_top_new')

        @include('website.partials.header_banner_new')

        @include('website.partials.header_menu_new')
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

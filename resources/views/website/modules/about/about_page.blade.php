@extends('website.master')

@section('content')
    <main class="about-page">
        @include('website.modules.about.banner')

        @include('website.modules.about.about')

        @include('website.modules.about.process')

        @include('website.modules.about.library_image')

        @include('website.modules.about.client')
    </main>
@endsection

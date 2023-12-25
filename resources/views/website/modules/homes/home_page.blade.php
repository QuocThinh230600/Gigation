@extends('website.master')

@section('content')
    <main class="home-page">
        @include('website.modules.homes.banner')

        @include('website.modules.homes.services')

        @include('website.modules.homes.features')

        @include('website.modules.homes.free_regis')

        @include('website.modules.homes.client')

        @include('website.modules.homes.testimonial')
    </main>
@endsection

@extends('website.master')

@section('content')
    <main class="contact-page">

        @include('website.modules.contact.banner')

        @include('website.modules.contact.contact')

        @include('website.modules.contact.free_regis')
    </main>
@endsection

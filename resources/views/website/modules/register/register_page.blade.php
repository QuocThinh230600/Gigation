@extends('website.master')

@section('content')
    <main class="register-page">
        <section class="main-layout">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 col-slider">
                        @include('website.modules.register.banner')
                    </div>
                    <div class="col-12 col-lg-4 col-form">
                        @include('website.modules.register.form_register')
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

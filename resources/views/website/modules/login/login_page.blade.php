@extends('website.master')

@section('content')
    <main class="register-page">
        <section class="main-layout">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 col-slider">
                        @include('website.modules.login.banner')
                    </div>
                    <div class="col-12 col-lg-4 col-form">
                        <div class="form-wrap">
                            @include('website.modules.login.login_form')

                            @include('website.modules.login.typical_serices')

                            @include('website.modules.login.back_home')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

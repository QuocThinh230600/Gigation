@extends('website.modules.news.new_page')

@section('content')
    <main class="news-page">
        <section class="hero-news">
            <div class="container">
                @include('website.modules.news.new_top')

                @include('website.modules.news.trend_new')
            </div>
        </section>

        <section class="main-news">
            <div class="container">
                <h3 class="title">Blog tin tức</h3>
                <div class="row news-wrap">
                    <div class="col-12 col-lg-8 col-left">
                        @include('website.modules.news.lastest_new')

                        @include('website.modules.news.featured_news')

                        @include('website.modules.news.hot_new')

                        @include('website.modules.news.discovery_new')
                    </div>
                    <div class="col-12 col-lg-4 col-right col-side-bar">
                        @include('website.partials.category_new')

                        @include('website.partials.nomination_new')

                        @include('website.partials.tag_new')
                    </div>
                </div>
                <div class="row news-form">
                    <div class="col-12">
                        @include('website.partials.form_new')
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

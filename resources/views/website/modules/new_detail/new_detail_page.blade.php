@extends('website.modules.news.new_page')

@section('content')
    <main class="news-detail-page">
        <div class="container">
            @include('website.modules.new_detail.breadcrumb')
        </div>
        <section class="main-news">
            <div class="container">
                <div class="row news-wrap">
                    @include('website.modules.new_detail.new_detail_content')
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

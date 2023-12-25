@extends('website.modules.news.new_page')

@section('content')
    <main class="news-type-page">

        <section class="main-news">
            <div class="container">
                <div class="row news-wrap">
                    <div class="col-12 col-lg-8 col-left">
                        <h3 class="title">{{$CateName}}</h3>
                        @include('website.modules.new_type.new_type_top')

                        @include('website.modules.new_type.new_type_list')
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

@extends('website.modules.news.new_page')

@section('content')
    <main class="news-type-page">

        <section class="main-news">
            <div class="container">
                <div class="row news-wrap">
                    <div class="col-12 col-lg-8 col-left">
                        <h3 class="title">Trang tìm kiếm</h3>
                        <h5>Từ khóa tìm kiếm: {{$key}}</h5>
                        <div class="latest-news">
                            <div class="tab-content-wrap">
                                <div class="news-list">
                                    @if (count($Search) == 0)
                                        <h1 style="height: 50vh; padding: 40px; font-size: 30px">Không có kết quả cho tìm kiếm . . .</h1>
                                    @else
                                        @foreach ($Search as $item)
                                            <div class="news__item">
                                                <div class="img">
                                                    <a href="{{route('new_detail', $item->slug)}}"><img src="{{$item->image}}" alt=""></a>
                                                </div>
                                                <div class="desc">
                                                    <ul class="meta__tag">
                                                        <li><a href="" class="post-author">By {{$item->author}}</a></li>
                                                        <li><a href="" class="post-date">{{$item->created_at}}</a></li>
                                                    </ul>
                                                    <h4 class="entry__title">
                                                        <a href="news-detail.html">{{$item->title}}</a>
                                                    </h4>
                                                    <p class="excerpt">{!! strip_tags($item->intro) !!}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        
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
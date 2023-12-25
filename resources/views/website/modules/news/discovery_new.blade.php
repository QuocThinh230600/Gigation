<div class="featured-news-fluid discovery-news">
    <div class="news-container">
        <div class="title">
            <h3 class="title__large">Khám phá</h3>
            <div class="overflow-container">
                <ul class="title__list">
                    <li data-tab="tab1"><a href="javascript:(0)">All</a></li>
                    <li data-tab="tab2"><a href="javascript:(0)">Tin tức</a></li>
                    <li data-tab="tab3"><a href="javascript:(0)">Tin tuyển dụng</a></li>
                    <li data-tab="tab4"><a href="javascript:(0)">Tin thương mại</a></li>
                </ul>
            </div>
            <div class="entry-arrow-btn">
                <div class="prev-btn">
                    <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                </div>
                <div class="next-btn">
                    <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                </div>
            </div>
        </div>

        <div class="featured-news-carousel active" id="tab1">
            @php
                $check = true;
            @endphp
            @foreach ($AllNews as $key => $GetNew)
                @if ($key % 3 == 0)
                    <div class="carousel-cell">
                        <div class="news-wrap">
                @endif

                    @if ($check)
                        <div class="news__left">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="{{route('new_detail', $GetNew->slug)}}">{{$GetNew->title}}</a>
                                    </h4>
                                    <p class="excerpt">{!! strip_tags($GetNew->intro) !!}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            $check = true;
                        @endphp
                    @else
                        <div class="news__right">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="">{{$GetNew->title}}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif
                @if ($key % 3 == 2)
                        </div>
                    </div>
                @endif
            @endforeach
                @if ($key % 3 != 2)
                        </div>
                    </div>
                @endif
        </div>
        <div class="featured-news-carousel" id="tab2">
            @php
                $check = true;
            @endphp
            @foreach ($GetNews as $key => $GetNew)
                @if ($key % 3 == 0)
                    <div class="carousel-cell">
                        <div class="news-wrap">
                @endif

                    @if ($check)
                        <div class="news__left">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="{{route('new_detail', $GetNew->slug)}}">{{$GetNew->title}}</a>
                                    </h4>
                                    <p class="excerpt">{!! strip_tags($GetNew->intro) !!}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            $check = true;
                        @endphp
                    @else
                        <div class="news__right">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="">{{$GetNew->title}}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif
                @if ($key % 3 == 2)
                        </div>
                    </div>
                @endif
            @endforeach
                @if ($key % 3 != 2)
                        </div>
                    </div>
                @endif
        </div>
        <div class="featured-news-carousel" id="tab3">
            @php
                $check = true;
            @endphp
            @foreach ($GetNewsRecruitments as $key => $GetNew)
                @if ($key % 3 == 0)
                    <div class="carousel-cell">
                        <div class="news-wrap">
                @endif

                    @if ($check)
                        <div class="news__left">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="{{route('new_detail', $GetNew->slug)}}">{{$GetNew->title}}</a>
                                    </h4>
                                    <p class="excerpt">{!! strip_tags($GetNew->intro) !!}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            $check = true;
                        @endphp
                    @else
                        <div class="news__right">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="">{{$GetNew->title}}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif
                @if ($key % 3 == 2)
                        </div>
                    </div>
                @endif
            @endforeach
                @if ($key % 3 != 2)
                        </div>
                    </div>
                @endif
        </div>
        <div class="featured-news-carousel" id="tab4">
            @php
                $check = true;
            @endphp
            @foreach ($GetNewsCommerces as $key => $GetNew)
                @if ($key % 3 == 0)
                    <div class="carousel-cell">
                        <div class="news-wrap">
                @endif

                    @if ($check)
                        <div class="news__left">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="{{route('new_detail', $GetNew->slug)}}" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="{{route('new_detail', $GetNew->slug)}}">{{$GetNew->title}}</a>
                                    </h4>
                                    <p class="excerpt">{!! strip_tags($GetNew->intro) !!}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            $check = true;
                        @endphp
                    @else
                        <div class="news__right">
                            <div class="item">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                                </div>
                                <div class="desc">
                                    <ul class="meta__tag">
                                        <li><a href="" class="post-author">By {{$GetNew->author}}</a></li>
                                        <li><a href="" class="post-date">{{$GetNew->created_at}}</a></li>
                                    </ul>
                                    <h4 class="entry__title">
                                        <a href="">{{$GetNew->title}}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif
                @if ($key % 3 == 2)
                        </div>
                    </div>
                @endif
            @endforeach
                @if ($key % 3 != 2)
                        </div>
                    </div>
                @endif
        </div>
    </div>
</div>

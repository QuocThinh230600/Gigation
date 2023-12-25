<div class="latest-news">
    <div class="left__title">
        <h3 class="title__large">Mới nhất</h3>
        <div class="overflow-container">
            <ul class="title__list">
                <li data-tab="tab1"><a href="javascript:(0)">All</a></li>
                <li data-tab="tab2"><a href="javascript:(0)">Tin tức</a></li>
                <li data-tab="tab3"><a href="javascript:(0)">Tin tuyển dụng</a></li>
                <li data-tab="tab4"><a href="javascript:(0)">Tin thương mại</a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content-wrap">
        <div class="news-grid active" id="tab1">
            @php
                $check = true;
            @endphp
            @foreach ($AllNews as $AllNew)
                @if ($check)
                    <div class="news__item">
                        <div class="img">
                            <a href="{{route('new_detail', $AllNew->slug)}}"><img src="{{$AllNew->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-category">
                                    @foreach ($AllNew->category()->get() as $item)
                                        @php
                                            echo $item->name;
                                            break;
                                        @endphp
                                    @endforeach
                                </a></li>
                                <li><a href="" class="post-author">By {{$AllNew->author}}</a></li>
                                <li><a href="" class="post-date">{{$AllNew->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $AllNew->slug)}}">{{$AllNew->title}}</a>
                            </h4>
                            <p class="excerpt">{!! strip_tags($AllNew->intro) !!}</p>
                        </div>
                    </div>
                    @php
                        $check = false;
                    @endphp
                @else
                    <div class="news__item item-sub">
                        <div class="img">
                            <a href="{{route('new_detail', $AllNew->slug)}}"><img src="{{$AllNew->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-author">By {{$AllNew->author}}</a></li>
                                <li><a href="" class="post-date">{{$AllNew->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $AllNew->slug)}}s">{{$AllNew->title}}</a>
                            </h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="news-grid" id="tab2">
            @php
                $check = true;
            @endphp
            @foreach ($GetNews as $GetNew)
                @if ($check)
                    <div class="news__item">
                        <div class="img">
                            <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-category">
                                    @foreach ($GetNew->category()->get() as $item)
                                        @php
                                            echo $item->name;
                                            break;
                                        @endphp
                                    @endforeach
                                </a></li>
                                <li><a href="" class="post-author">By {{$GetNew->author}}</a></li>
                                <li><a href="" class="post-date">{{$GetNew->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $GetNew->slug)}}">{{$GetNew->title}}</a>
                            </h4>
                            <p class="excerpt">{!! strip_tags($GetNew->intro) !!}</p>
                        </div>
                    </div>
                    @php
                        $check = false;
                    @endphp
                @else
                    <div class="news__item item-sub">
                        <div class="img">
                            <a href="{{route('new_detail', $GetNew->slug)}}"><img src="{{$GetNew->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-author">By {{$GetNew->author}}</a></li>
                                <li><a href="" class="post-date">{{$GetNew->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $GetNew->slug)}}">{{$GetNew->title}}</a>
                            </h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="news-grid" id="tab3">
            @php
                $check = true;
            @endphp
            @foreach ($GetNewsRecruitments as $GetNewsRecruitment)
                @if ($check)
                    <div class="news__item">
                        <div class="img">
                            <a href="{{route('new_detail', $GetNewsRecruitment->slug)}}"><img src="{{$GetNewsRecruitment->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-category">
                                    @foreach ($GetNewsRecruitment->category()->get() as $item)
                                        @php
                                            echo $item->name;
                                            break;
                                        @endphp
                                    @endforeach
                                </a></li>
                                <li><a href="" class="post-author">By {{$GetNewsRecruitment->author}}</a></li>
                                <li><a href="" class="post-date">{{$GetNewsRecruitment->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $GetNewsRecruitment->slug)}}">{{$GetNewsRecruitment->title}}</a>
                            </h4>
                            <p class="excerpt">{!! strip_tags($GetNewsRecruitment->intro) !!}</p>
                        </div>
                    </div>
                    @php
                        $check = false;
                    @endphp
                @else
                    <div class="news__item item-sub">
                        <div class="img">
                            <a href="{{route('new_detail', $GetNewsRecruitment->slug)}}"><img src="{{$GetNewsRecruitment->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-author">By {{$GetNewsRecruitment->author}}</a></li>
                                <li><a href="" class="post-date">{{$GetNewsRecruitment->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="">{{$GetNewsRecruitment->title}}</a>
                            </h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="news-grid" id="tab4">
            @php
                $check = true;
            @endphp
            @foreach ($GetNewsCommerces as $GetNewsCommerce)
                @if ($check)
                    <div class="news__item">
                        <div class="img">
                            <a href="{{route('new_detail', $GetNewsCommerce->slug)}}"><img src="{{$GetNewsCommerce->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-category">
                                    @foreach ($GetNewsCommerce->category()->get() as $item)
                                        @php
                                            echo $item->name;
                                            break;
                                        @endphp
                                    @endforeach
                                </a></li>
                                <li><a href="" class="post-author">By {{$GetNewsCommerce->author}}</a></li>
                                <li><a href="" class="post-date">{{$GetNewsCommerce->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $GetNewsCommerce->slug)}}">{{$GetNewsCommerce->title}}</a>
                            </h4>
                            <p class="excerpt">{!! strip_tags($GetNewsCommerce->intro) !!}</p>
                        </div>
                    </div>
                    @php
                        $check = false;
                    @endphp
                @else
                    <div class="news__item item-sub">
                        <div class="img">
                            <a href="{{route('new_detail', $GetNewsCommerce->slug)}}"><img src="{{$GetNewsCommerce->image}}" alt=""></a>
                        </div>
                        <div class="desc">
                            <ul class="meta__tag">
                                <li><a href="" class="post-author">By {{$GetNewsCommerce->author}}</a></li>
                                <li><a href="" class="post-date">{{$GetNewsCommerce->created_at}}</a></li>
                            </ul>
                            <h4 class="entry__title">
                                <a href="{{route('new_detail', $GetNewsCommerce->slug)}}">{{$GetNewsCommerce->title}}</a>
                            </h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
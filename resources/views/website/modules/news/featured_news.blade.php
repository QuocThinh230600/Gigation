<div class="featured-news">
    <div class="news__left">
        <div class="title">
            <h3 class="title__large">Tin hay</h3>
            <div class="entry-arrow-btn">
                <div class="prev-btn">
                    <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                </div>
                <div class="next-btn">
                    <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                </div>
            </div>
        </div>
        <div class="featured-news-carousel">
            @foreach ($GetNewsNices as $key => $GetNewsNice)
                @if ($key % 3 == 0)
                    <div class="carousel-cell">
                @endif
                        <div class="cell__content">
                            <div class="img">
                                <a href="{{route('new_detail', $GetNewsNice->slug)}}"><img src="{{$GetNewsNice->image}}" alt=""></a>
                            </div>
                            <h3 class="entry-title"><a href="{{route('new_detail', $GetNewsNice->slug)}}s">{{$GetNewsNice->title}}</a></h3>
                        </div>
                @if ($key % 3 == 2)
                    </div>
                @endif
            @endforeach
            @if ($key % 3 != 2)
                    </div>
            @endif
        </div>
    </div>
    <div class="news__right">
        <div class="title">
            <h3 class="title__large">Kiến thức</h3>
            <div class="entry-arrow-btn">
                <div class="prev-btn">
                    <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                </div>
                <div class="next-btn">
                    <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                </div>
            </div>
        </div>
        <div class="featured-news-carousel">
           @php
               $check = true;
           @endphp
            @foreach ($GetNewsKnowledges as $key => $GetNewsKnowledge)
                @if ($key % 3 == 0)
                    @php
                        $check = true;
                    @endphp
                    <div class="carousel-cell">
                @endif
                    @if ($check)
                        <div class="cell__content">
                            <div class="img">
                                <a href="{{route('new_detail',$GetNewsKnowledge->slug)}}"><img src="{{$GetNewsKnowledge->image}}" alt=""></a>
                            </div>
                            <div class="desc">
                                <ul class="meta__tag">
                                    <li><a href="" class="post-category">
                                        @foreach ($GetNewsKnowledge->category()->get() as $item)
                                            @php
                                                echo $item->name;
                                                break;
                                            @endphp
                                        @endforeach
                                    </a></li>
                                    <li><a href="" class="post-author">By {{$GetNewsKnowledge->author}}</a></li>
                                    <li><a href="" class="post-date">{{$GetNewsKnowledge->created_at}}</a></li>
                                </ul>
                                <h4 class="entry__title">
                                    <a href="{{route('new_detail',$GetNewsKnowledge->slug)}}">{{$GetNewsKnowledge->title}}</a>
                                </h4>
                                <p class="excerpt">{!! strip_tags($GetNewsKnowledge->intro) !!}</p>
                            </div>
                        </div>
                        @php
                            $check = false;
                        @endphp
                    @else
                        <div class="cell__content-sub">
                            <div class="img">
                                <a href="{{route('new_detail',$GetNewsKnowledge->slug)}}"><img src="{{$GetNewsKnowledge->image}}" alt=""></a>
                            </div>
                            <div class="desc">
                                <ul class="meta__tag">
                                    <li><a href="" class="post-category">
                                        @foreach ($GetNewsKnowledge->category()->get() as $item)
                                            @php
                                                echo $item->name;
                                                break;
                                            @endphp
                                        @endforeach
                                    </a></li>
                                    <li><a href="{{route('new_detail',$GetNewsKnowledge->slug)}}" class="post-author">By {{$GetNewsKnowledge->author}}</a></li>
                                    <li><a href="{{route('new_detail',$GetNewsKnowledge->slug)}}" class="post-date">{{$GetNewsKnowledge->created_at}}</a></li>
                                </ul>
                                <h4 class="entry__title">
                                    <a href="{{route('new_detail',$GetNewsKnowledge->slug)}}">{{$GetNewsKnowledge->title}}</a>
                                </h4>
                            </div>
                        </div>
                    @endif
                @if ($key % 3 == 2)
                    </div>
                @endif
            @endforeach
                @if ($key % 3 != 2)
                    </div>
                @endif




        </div>
    </div>
</div>

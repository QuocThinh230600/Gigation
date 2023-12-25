<div class="featured-news-fluid">
    <div class="news-container">
        <div class="title">
            <h3 class="title__large">Tin nổi bật</h3>
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
            @foreach ($GetNewsFeatureis as $key => $GetNewsFeatured)
                @if ($key % 5 == 0)
                    @php
                        $check = true;
                    @endphp
                    <div class="carousel-cell">
                @endif
                    @if ($check)
                        <div class="cell__content-large">
                            <a href="{{route('new_detail', $GetNewsFeatured->slug)}}">
                                <img src="{{$GetNewsFeatured->image}}" alt="">
                            </a>
                            <div class="meta-info-container">
                                <ul class="meta__tag">
                                    <li><a href="{{route('new_detail', $GetNewsFeatured->slug)}}" class="post-category">
                                        @foreach ($GetNewsFeatured->category()->get() as $item)
                                            @php
                                                echo $item->name;
                                                break;
                                            @endphp
                                        @endforeach
                                    </a></li>
                                </ul>
                                <h3 class="entry-title">{{$GetNewsFeatured->title}}</h3>
                            </div>
                        </div>
                        @php
                            $check = false;
                        @endphp
                    @else

                        @if ($key % 5 == 1)
                            <div class="cell__content-horizontal">
                        @endif

                            <div class="cell__content">
                                <div class="img">
                                    <a href="{{route('new_detail', $GetNewsFeatured->slug)}}"><img src="{{$GetNewsFeatured->image}}" alt=""></a>
                                </div>
                                <h3 class="entry-title"><a href="">{{$GetNewsFeatured->title}}</a></h3>
                            </div>

                        @if ($key % 5 == 4)
                            </div>
                        @endif

                    @endif

                @if ($key % 5 == 4)
                    </div>
                @endif
            @endforeach
                @if ($key % 5 != 4)
                    </div>
                @endif
        </div>
    </div>
</div>

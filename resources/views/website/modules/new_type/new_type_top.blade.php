<div class="hero-news__row">
    @php
        $check = true;
    @endphp
    @foreach ($newsTop as $newsT)
        @if ($check)
            <div class="news-item">
                <a href="{{route('new_detail', $newsT->slug)}}">
                    <img src="{{$newsT->image}}" alt="">
                </a>
                <div class="meta-info-container">
                    <ul class="meta__tag">
                        <li><a href="{{route('new_detail', $newsT->slug)}}" class="post-category">
                            @foreach ($newsT->category()->get() as $item)
                                @php
                                    echo $item->name;
                                    break;
                                @endphp
                            @endforeach
                        </a></li>
                        <li><a href="{{route('new_detail', $newsT->slug)}}" class="post-author">By {{$newsT->author}}</a></li>
                        <li><a href="{{route('new_detail', $newsT->slug)}}" class="post-date">{{$newsT->created_at}}</a></li>
                    </ul>
                    <h3 class="entry-title">{{$newsT->title}}</h3>
                </div>
            </div>
        @php
            $check = false;
        @endphp
        @else
            <div class="news-item item-secondary">
                <a href="{{route('new_detail', $newsT->slug)}}">
                    <img src="{{$newsT->image}}" alt="">
                </a>
                <div class="meta-info-container">
                    <ul class="meta__tag">
                        <li><a href="{{route('new_detail', $newsT->slug)}}" class="post-category">
                            @foreach ($newsT->category()->get() as $item)
                                @php
                                    echo $item->name;
                                    break;
                                @endphp
                            @endforeach
                        </a></li>
                        <li><a href="{{route('new_detail', $newsT->slug)}}" class="post-author">By {{$newsT->author}}</a></li>
                        <li><a href="{{route('new_detail', $newsT->slug)}}" class="post-date">{{$newsT->created_at}}</a></li>
                    </ul>
                    <h3 class="entry-title">{!! strip_tags($newsT->intro) !!}</h3>
                </div>
            </div>
        @endif
    @endforeach
</div>
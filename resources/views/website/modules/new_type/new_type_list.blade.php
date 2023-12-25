<div class="latest-news">
    <div class="tab-content-wrap">
        <div class="news-list">
            @foreach ($newsList as $newsL)
                <div class="news__item">
                    <div class="img">
                        <a href="{{route('new_detail', $newsL->slug)}}"><img src="{{$newsL->image}}" alt=""></a>
                    </div>
                    <div class="desc">
                        <ul class="meta__tag">
                            <li><a href="" class="post-author">By {{$newsL->author}}</a></li>
                            <li><a href="" class="post-date">{{$newsL->created_at}}</a></li>
                        </ul>
                        <h4 class="entry__title">
                            <a href="news-detail.html">{{$newsL->title}}</a>
                        </h4>
                        <p class="excerpt">{!! strip_tags($newsL->intro) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('website.modules.new_type.pagination', ['paginator'=>$newsList])
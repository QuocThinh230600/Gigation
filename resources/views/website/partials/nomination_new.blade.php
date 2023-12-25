<div class="news-relate-wrap">
    <div class="right__title">
        <h3 class="title__large">tin đề cử</h3>
    </div>
    @foreach ($News as $New)
        <div class="news__item">
            <div class="img">
                <a href="{{route('new_detail', $New->slug)}}"><img src="{{$New->image}}" alt=""></a>
            </div>
            <div class="desc">
                <ul class="meta__tag"> 
                    <li><a href="{{route('new_detail', $New->slug)}}" class="post-author">By {{$New->author}}</a></li>
                    <li><a href="{{route('new_detail', $New->slug)}}" class="post-date">{{$New->created_at}}</a></li>
                </ul>
                <h4 class="entry__title">
                    <a href="{{route('new_detail', $New->slug)}}">{{$New->title}}</a>
                </h4>
            </div>
        </div>
    @endforeach
</div>
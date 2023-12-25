<div class="trend-news__row">
    <div class="title">
        <h4>MỚI NHẤT</h4>
    </div>
    <div class="trend-entry">
        <div class="trend-entry-carousel data-carousel">
            @foreach ($AllNews as $AllNew)
                <div class="carousel-cell">
                    <a href="{{route('new_detail',$AllNew->title)}}">{{$AllNew->title}}</a>
                </div>
            @endforeach
        </div>
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

<section class="services">
    <div class="container">
        <h4 class="title-section">{!! strip_tags($home[0]['content']) !!}</h4>
        <div class="row">
            @foreach ($category as $item)
            <div class="col-12 col-lg-4 col-item">
                <div class="service__item">
                    <a href="{{route('category', $item->slug)}}">
                        <img class="svg" src="{{$item->image}}" alt="">
                    </a>
                    <a href="{{route('category', $item->slug)}}">
                        <h3 class="small-title">{{$item->name}}</h3>
                    </a>
                    <p>{!! strip_tags($item->description)!!}</p>
                    <a href="{{route('category', $item->slug)}}" class="main-btn">Tìm hiểu thêm</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

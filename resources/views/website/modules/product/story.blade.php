<section class="story" style="background-image: url({{asset('website/img/story-bg.svg')}});">
    <div class="container">
        <div class="story-title">
            <h5>KHÁCH HÀNG NÓI VỀ CLOUD SERVER CỦA GIGATON</h5>
        </div>
        <div class="story-carousel">
            @foreach ($customer as $item)
            <div class="carousel-cell">
                <div class="cell__inner" style="background-image: url({{asset('website/img/story-carousel-bg.png')}})">
                    <p class="content-story">{!! strip_tags($item->content)!!}</p>
                    <div class="content-info">
                        <img src="{{$item->image}}" alt="">
                        <div class="info">
                            <h5 class="name">{{$item->name}}</h5>
                            <p class="company">{{$item->link}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

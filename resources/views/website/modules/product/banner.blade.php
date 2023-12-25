<section class="hero-banner">
    <div class="hero-product-carousel">
        @foreach ($category->advantages()->where('position', 1)->get() as $item)
        <div class="carousel-cell">
            <div class="cell__item data-bg" data-bg-src="{{$item->image}}">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 offset-md-6">
                            <h2 class="title">{!!strip_tags($item->title)!!}</h2>
                            <p class="desc">{!!strip_tags($item->content)!!}</p>
                            <a href="{{route('register')}}" class="main-btn carousel-btn">Đăng ký ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

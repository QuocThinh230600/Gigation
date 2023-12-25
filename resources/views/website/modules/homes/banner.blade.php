<section class="hero-banner">

    <div class="hero-carousel">
        @foreach ($image_top as $item)
        <div class="carousel-cell" id="carousel-cell">
            <div class="cell__item data-bg" data-bg-src="{{ asset('website/img/hero-bg1.svg') }}">
                <img src="{{ $item->image }}" onerror="this.src='{{$error_image}}'" alt="">
                <div class="container">
                    <a href="{{ $item->link }}" class="main-btn banner-btn">
                        Tìm hiểu thêm
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</section>

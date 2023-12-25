<div class="register-banner-carousel">
    @foreach ($image_banner as $item)
    <div class="carousel-cell">
        <img src="{{$item->image}}" alt="">
    </div>
    @endforeach
</div>

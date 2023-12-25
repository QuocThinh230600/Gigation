<section class="client">
    <div class="container">
        <h3 class="title-section">KHÁCH HÀNG CỦA GIGATON</h3>
        <div class="client-carousel">
            @foreach ($image_client as $item)
            <div class="carousel-cell">
                <img src="{{$item->image}}" onerror="this.src='{{$error_image}}'" alt="">
            </div>
            @endforeach
        </div>
    </div>
</section>

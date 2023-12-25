<section class="testimonial">
    <div class="container">
        <div class="testimonial-carousel">
            @foreach ($customer as $item)
            <div class="carousel-cell">
                <div class="testimonial__content">
                    <p class="quote">{!! strip_tags($item->content) !!}</p>
                    <img src="{{$item->image}}" alt="" class="avt">
                    <p class="name">{{$item->name}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
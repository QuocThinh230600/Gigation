<section class="client">
    <div class="container">
        <h3 class="title-section">{!! strip_tags($home[23]['content']) !!}</h3>
        <div class="row client-icon">
            @foreach ($image_client as $item)
            <div class="col-6 col-md-3">
                <a href="{{$item->link}}"><img src="{{$item->image}}"  onerror="this.src='{{$error_image}}'"  alt=""></a>
            </div>
            @endforeach
        </div>
        <div class="row client-icon">
            @foreach ($image_client1 as $item)
            <div class="col-6 col-md-3">
                <a href="{{$item->link}}"><img src="{{$item->image}}"  onerror="this.src='{{$error_image}}'"  alt=""></a>
            </div>
            @endforeach
        </div>
    </div>
</section>

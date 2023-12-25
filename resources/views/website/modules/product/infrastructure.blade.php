<section class="infrastructure">
    <div class="container">
        @foreach ($category->advantages()->where('position', 9)->get() as $item)
        <h3 class="title">{!!strip_tags($item->title)!!}</h3>
        @endforeach
        <div class="row">
            <div class="col-12 col-md-6">
                @foreach ($category->advantages()->where('position', 9)->get() as $item)
                <img src="{{$item->image}}" alt="">
                @endforeach
            </div>
            <div class="col-12 col-md-6">
                @foreach ($category->advantages()->where('position', 10)->get() as $item)
                <div class="item">
                    <div class="item__icon">
                        <img src="{{$item->image}}" alt="">
                    </div>
                    <div class="item__content">
                        <h5>{!!strip_tags($item->title)!!}</h5>
                        <p>{!!strip_tags($item->content)!!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

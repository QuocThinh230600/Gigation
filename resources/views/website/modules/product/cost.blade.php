<section class="costs">
    <div class="container">
        @foreach ($category->advantages()->where('position', 7)->get() as $item)
        <div class="title-cost">
            <h4 class="title">{!!strip_tags($item->title)!!}</h4>
            <p class="sub-title">{!!strip_tags($item->content)!!}</p>
        </div>
        @endforeach
        <div class="row row-cost">
            @foreach ($category->advantages()->where('position', 8)->get() as $item)
            <div class="col-xs-6 col-md-3 content-cost">
                <img src="{{$item->image}}" alt="">
                <h4 class="title-cost">{!!strip_tags($item->title)!!}</h4>
                <p class="desc-cost">{!!strip_tags($item->content)!!}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

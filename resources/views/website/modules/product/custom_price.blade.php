<section class="custom-price">
    <div class="container">
        <div class="custom-title">
            @foreach ($category->advantages()->where('position', 3)->get() as $item)
            <h3 class="title">{!!strip_tags($item->title)!!}</h3>
            <p class="sub-title">{!!strip_tags($item->content)!!}</p>
            @endforeach
        </div>
        <div class="row trial">
            <div class="col-12 col-md-5 col-left">
                @foreach ($category->advantages()->where('position', 4)->get() as $item)
                <h4 class="title">{!!strip_tags($item->title)!!}</h4>
                <div class="detail">
                    <h6>{!!strip_tags($item->content)!!}</h6>
                    <p>{!!strip_tags($item->subcontent)!!}</p>
                </div>
                @endforeach
                @foreach ($category->advantages()->where('position', 5)->get() as $item)
                <ul class="list-featured">
                    <li>{!!strip_tags($item->title)!!}</li>
                    <li>{!!strip_tags($item->content)!!}</li>
                    <li>{!!strip_tags($item->subcontent)!!}</li>
                </ul>
                @endforeach
                <a href="{{route('register')}}" class="main-btn regis-btn btn--hover">Đăng ký ngay</a>
            </div>
        </div>
    </div>
</section>

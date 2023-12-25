<section class="product-intro">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-img">
                @foreach ($category->advantages()->where('position', 2)->get() as $item)
                <img src="{{$item->image}}" alt="">
                @endforeach
            </div>
            <div class="col-12 col-md-6 col-desc">
                <h3 class="title">{!!$categorytrans->title!!}</h3>
                <h5 class="sub-title">{!! $categorytrans->description!!}</h5>
                <p>{!! $categorytrans->content!!}</p>
                <a href="{{route('register')}}" class="main-btn intro-btn">Đăng ký ngay</a>
            </div>
        </div>
    </div>
</section>

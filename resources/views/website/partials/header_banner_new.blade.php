<div class="header-banner">
    <div class="container">
        <div class="header-banner__inner">
            <a href="{{route('home')}}"><img src="{{$config->value}}" alt="" class="logo"></a>
            <div class="banner">
                @foreach ($image as $item)
                <a href="{{$item->link}}"><img src="{{$item->image}}" alt=""></a>
                @endforeach
            </div>
        </div>
    </div>
</div>

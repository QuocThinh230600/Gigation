<div class="mobile-nav">
    <div class="close-btn">
        <img src="{{asset('website/img/close.svg')}}" alt="">
    </div>
    <div class="logo">
        @foreach ($image as $item)
        <a href="{{route('home')}}"><img src="{{$item->image}}" alt=""></a>
        @endforeach
    </div>
    <ul class="nav">
        <li class="nav-lv2-wrap">
            <a href="javascript:(0)" class="head-name">Dịch vụ <img src="{{asset('website/img/plus-icon.svg')}}" alt=""></a>
            <ul class="nav__lv2">
                @foreach ($category as $item)
                <li><a href="{{route('category', $item->slug)}}">{{$item->name}}</a></li>
                @endforeach
            </ul>
        </li>
        <li><a href="{{route('about')}}">Về chúng tôi</a></li>
        <li><a href="{{route('news')}}">Tin tức</a></li>
        <li><a href="{{route('contact')}}">Liên hệ</a></li>
        <li><a href="{{route('login')}}">Đăng nhập</a></li>
    </ul>
</div>

<div class="container">
    <div class="header-nav">
        <ul class="hamburger-icon">
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <ul class="nav__left">
            <li class="logo-wrap">
                <a href="{{route('home')}}"><img src="{{$config->value}}" alt="" class="logo"></a>
            </li>
            <li class="mega-menu">
                <a href="javascript:(0)">Dịch Vụ <img src="{{asset('website/img/down-arrow.svg')}}" alt="" class="svg"></a>
                <ul class="mega-menu-sub">
                    @foreach ($categorys as $cate)
                    <li>
                        <a href="{{route('category', $cate->slug)}}">{{$cate->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="{{route('about')}}">Về Chúng Tôi</a>
            </li>
            <li>
                <a href="{{route('news')}}">Tin Tức</a>
            </li>
            <li>
                <a href="{{route('contact')}}">Liên Hệ</a>
            </li>
        </ul>
        <ul class="nav__right">
            <li class="hotline-wrap">
                <a href="#" class="hotline-btn">
                    <img src="{{asset('website/img/icon-hotline.svg')}}" alt="" class="svg">
                    Hotline
                </a>
                <ul class="hover-hotline">
                    <li><a href="tel:{!! strip_tags($content[0]['content']) !!}">{!! strip_tags($content[0]['content']) !!}</a></li>
                </ul>
            </li>

            @if(Auth::user())
            <li class="hotline-wrap">
                <a href="#" class="hotline-btn">
                    <img src="{{asset('website/img/user-icon.svg')}}" alt="" class="svg">
                    {{ Auth::user()->full_name}}
                </a>
                <ul class="hover-hotline">
                    <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                </ul>
            </li>

            @else
            <li>
                <a href="{{route('login')}}" class="login-btn">
                    <img src="{{asset('website/img/user-icon.svg')}}" alt="" class="svg">
                    Đăng nhập
                </a>
            </li>
            <li>
                <a href="{{route('register')}}" class="login-btn">
                    Nhận báo giá
                </a>
            </li>
            @endif

        </ul>
    </div>
</div>

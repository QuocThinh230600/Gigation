<div class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 col-about">
                <a href="{{route('home')}}"><img src="{{$config->value}}" alt="" class="footer-logo"></a>
                <img src="" alt="" class="bo-cong-thuong">

                <ul>
                    <li>
                        <p>{!! strip_tags($content[0]['content']) !!}</p>
                    </li>
                    <li>
                        <p>{!! strip_tags($content[1]['content']) !!}</p>
                    </li>
                    <li>
                        <p>{!! strip_tags($content[2]['content']) !!}</p>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-nav">
                <h4 class="col-title">Sản phẩm</h4>
                <ul>
                    @foreach ($category as $cate)
                    <li><a href="{{route('category', $cate->slug)}}">{{$cate->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-nav">
                <h4 class="col-title">Về chúng tôi</h4>
                <ul>
                    <li><a href="{{route('about')}}">Giới thiệu</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                    <li><a href="#">Khách hàng</a></li>
                    <li><a href="{{route('news')}}">Tin tức</a></li>
                    <li><a href="#">Chính sách bảo mật</a></li>
                    <li><a href="#">Chính sách thanh toán</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-news">
                <h4 class="col-title">tin tức</h4>
                @foreach ($image as $item)
                <a href="{{route('news')}}"><img src="{{$item->image}}" alt=""></a>
                @endforeach
                <a href="{{route('news')}}" class="main-btn">ĐỌC TIN</a>
            </div>
        </div>
    </div>
</div>

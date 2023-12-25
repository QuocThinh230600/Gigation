<section class="pricing-table">
    <div class="container">
        <div class="pricing-title">
            @foreach ($category->advantages()->where('position', 6)->get() as $item)
            <h4 class="title">{!!strip_tags($item->title)!!}</h4>
            <p class="sub-title">{!!strip_tags($item->content)!!}</p>
            @endforeach
        </div>
        <div class="table-package">
            <div class="table-label">
                <div class="package-tag"></div>
                <ul class="list-desc">
                    <li class="name"></li>
                    @foreach ($attributeConfige as $item)
                        <li>{{$item->name}}</li>
                    @endforeach
                </ul>
                <ul class="list-price">
                    @foreach ($attributePackage as $item)
                    <li>
                        <div class="icon-box">
                            <img src="{{asset('website/img/rocket-launch.svg')}}" alt="">
                            <div class="text">
                                <h5>{{$item->name}}</h5>
                                <p>{!!strip_tags($item->description)!!}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="packages-table-wrap">
                @foreach ($product as $item)
                <div class="package">
                    <div class="package-tag">
                    </div>
                    <ul class="list-desc">
                        <li class="name">{{$item->name}}</li>
                        @foreach ($item->product_attribute()->leftJoin('attributes', 'attributes.id', '=', 'attribute')
                        ->where('parent_id', 18)
                        ->orderBy('attribute', 'DESC')->get() as $item1)
                        <li>{{$item1->value}}</li>
                        @endforeach
                    </ul>
                    <ul class="list-price">
                        @foreach ($item->product_attribute()->leftJoin('attributes', 'attributes.id', '=', 'attribute')
                        ->where('parent_id', 23)
                        ->orderBy('attribute', 'DESC')->get() as $item1)
                        <li>
                            <div class="price-box">
                                <div>
                                    <span class="price-value">{{$item1->value}}</span>
                                    <span class="small-text">VNĐ/tháng</span>
                                </div>
                                <a href="{{route('register')}}" class="main-btn btn--hover regis-btn">Đăng ký ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>
                @endforeach

                {{-- <div class="package active">
                    <div class="package-tag">
                        PHÙ HỢP VỚI CÁC ỨNG DỤNG VỪA VÀ NHỎ
                    </div>
                    <ul class="list-desc">
                        <li class="name">Gói Tiny</li>
                        <li>2 Cores</li>
                        <li>20 GB</li>
                        <li>2 Cores</li>
                        <li>
                            <img src="{{asset('website/img/tick.svg')}}" alt="">
                            Bandwidth
                        </li>
                        <li>
                            <img src="{{asset('website/img/tick.svg')}}" alt="">
                            Bandwidth
                        </li>
                    </ul>
                    <ul class="list-price">
                        <li>
                            <div class="price-box">
                                <div>
                                    <span class="price-value">194,640</span>
                                    <span class="small-text">VNĐ/tháng</span>
                                </div>
                                <a href="" class="main-btn btn--hover regis-btn">Đăng ký ngay</a>
                            </div>
                        </li>
                        <li>
                            <div class="price-box">
                                <div>
                                    <span class="price-value">194,640</span>
                                    <span class="small-text">VNĐ/tháng</span>
                                </div>
                                <a href="" class="main-btn btn--hover regis-btn">Đăng ký ngay</a>
                            </div>
                        </li>
                        <li>
                            <div class="price-box">
                                <div>
                                    <span class="price-value">194,640</span>
                                    <span class="small-text">VNĐ/tháng</span>
                                </div>
                                <a href="" class="main-btn btn--hover regis-btn">Đăng ký ngay</a>
                            </div>
                        </li>
                        <li>
                            <div class="price-box">
                                <div>
                                    <span class="price-value">194,640</span>
                                    <span class="small-text">VNĐ/tháng</span>
                                </div>
                                <a href="" class="main-btn btn--hover regis-btn">Đăng ký ngay</a>
                            </div>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</section>

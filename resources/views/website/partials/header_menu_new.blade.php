<div class="header-menu">
    <div class="container">
        <div class="header-menu__inner">
            <ul class="left">
                <li><a href="{{route('home')}}">Trang Chủ</a></li>
                @foreach ($categorys as $category)
                    <li><a href="{{route('newtype', $category->slug)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
            <ul class="right">
                <li class="news-hamburger-icon"><a href="javascript:(0)"><img src="{{asset('website/img/menu.svg')}}" alt=""></a>
                </li>
                <li class="news-search-icon"><a href="javascript:(0)"><img src="{{asset('website/img/search.svg')}}" alt=""></a>
                    <div class="dropdown-header-search">
                        <form action="{{route('searchnew')}}" method="GET" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="key" placeholder="Tìm kiếm">
                                <button class="submit-btn">Search</button>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

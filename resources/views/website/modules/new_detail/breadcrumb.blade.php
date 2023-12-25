<ul class="breadcrumb">
    <li><a href="{{route('home')}}">Trang chủ</a></li>
    <li class="arrow"><img src="{{asset('website/img/down-arrow.svg')}}" alt="" class="svg"></li>

    <li><a href="{{route('newtype',$CategoryB->slug)}}">{{$CategoryB->name}}</a></li>
</ul>

<div class="form-wrap">
    <form action="{{route('checkregister')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="form-title">Đăng ký tài khoản</h2>
        <div class="form-group">
            <input class="form-control" name="full_name" type="text" placeholder="Họ tên" required>
            <img src="{{asset('website/img/user-icon.svg')}}" alt="" class="svg">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="phone" placeholder="Số điện thoại *" required>
            <img src="{{asset('website/img/mobile-phone.svg')}}" alt="" class="svg">
        </div>
        <div class="form-group">
            <input class="form-control" name="email" type="email" placeholder="Email *" required>
            <img src="{{asset('website/img/mail.svg')}}" alt="" class="svg">
        </div>
        <div class="form-group">
            <select name="message" id="cars" required>
                <option  disabled selected>Dịch vụ muốn sử dụng</option>
                @foreach ($categoryName as $item)
                    <option value="{{$item->name}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button class="main-btn btn-submit">Đăng ký ngay</button>
        </div>
    </form>

    @if(session('alert'))
        <section class='alert alert-success'>{{session('alert')}}</section>
    @endif  

    <div class="account-rules">
        <p>{!! strip_tags($content[0]['content'])!!} <a href="{!! strip_tags($content[1]['content'])!!}">{!! strip_tags($content[2]['content'])!!}</a></p>
        <p>Đã có tài khoản <a href="{{route('login')}}">Đăng nhập</a></p>
    </div>
    <div class="typical-serices">
        <h5>Dịch vụ tiêu biểu</h5>
        <ul class="list-service">
            @foreach ($categoryName as $item)
            <li class="icon__service">
                <a href="{{route('category', $item->slug)}}"><img src="{{$item->image}}" alt=""></a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="back-home">
        <img src="{{asset('website/img/down-arrow.svg')}}" alt="" class="svg">
        <a href="{{route('home')}}">Trở về trang chủ</a>
    </div>
</div>

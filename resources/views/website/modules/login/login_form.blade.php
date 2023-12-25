@push('themejs')

<script src="{{ asset(GLOBAL_ASSETS_JS.'main/jquery.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_JS.'main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_JS.'plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset(GLOBAL_ASSETS_PLUG.'notifications/pnotify.min.js') }}"></script>
<script src="{{ asset(LANG_PATH.'vi.js') }}"></script>

@endpush


<form action="{{ route('checklogin')}}" method="POST" id="formAuth" autocomplete="off">
    @csrf
    @method('POST')

    @include('authentication.partials.alert')

    <h2 class="form-title">Đăng nhập</h2>
    <div class="form-group">
        <input class="form-control" type="email" placeholder="Email *" name="email">
        <img src="{{asset('website/img/mail.svg')}}" alt="" class="svg">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" placeholder="Mật khẩu *" name="password">
    </div>
    <div class="form-group">
        <button class="main-btn btn-submit">Đăng nhập</button>
        <div class="back-home">
            <a href="{{ route('auth.showForgotForm') }}">Quên mật khẩu</a><br>
        </div>
    </div>
    
    <div class="back-home">
        <span>Khách hàng mới? -</span>
        <a href="{{ route('register') }}"> Đăng ký ngay</a><br>
    </div>
    
</form>

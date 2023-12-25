<section class="platform-support">
    <div class="container">
        <div class="platform-title">
            <h6 class="title"> CÁC HỆ ĐIỀU HÀNH OS ĐƯỢC GIGATON CLOUD SERVER HỖ TRỢ </h6>
        </div>
        <div class="row platform-row">
            @foreach ($image_platform_support as $item)
            <div class="col-6 col-md-3 platform-col">
                <img src="{{$item->image}}" alt="">
                <h6 class="name">{{$item->name}}</h6>
            </div>
            @endforeach
        </div>
    </div>
</section>

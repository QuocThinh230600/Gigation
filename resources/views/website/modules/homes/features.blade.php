<section class="features">
    <div class="container">
        <h4 class="title-section">{!! strip_tags($home[7]['content']) !!}</h4>
        <div class="row features-icon-wrap">
            <div class="col-md-4 col-item left">
                <div class="row item-wrap" data-aos="fade-right" data-aos-easing="linear"
                data-aos-duration="500">
                    <div>
                        <div class="col-12 item__inner">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="small-title">{!! strip_tags($home[8]['content']) !!}</h3>
                                    <p>{!! strip_tags($home[9]['content']) !!}</p>
                                </div>
                                <div class="col-3">
                                    <img src="{{$home[8]['image'] }}" alt="" class="svg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 item__inner">
                        <div class="row">
                            <div class="col-9">
                                <h3 class="small-title">{!! strip_tags($home[10]['content']) !!}</h3>
                                <p>{!! strip_tags($home[11]['content']) !!}</p>
                            </div>
                            <div class="col-3">
                                <img src="{{$home[10]['image'] }}" alt="" class="svg">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 item__inner">
                        <div class="row">
                            <div class="col-9">
                                <h3 class="small-title">{!! strip_tags($home[12]['content']) !!}</h3>
                                <p>{!! strip_tags($home[13]['content']) !!}</p>
                            </div>
                            <div class="col-3">
                                <img src="{{$home[12]['image'] }}" alt="" class="svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 center">
                @if ($image_benefit)
                    @foreach ($image_benefit as $item)
                        <img src="{{$item->image}}" alt="">
                    @endforeach
                @endif
                
            </div>
            <div class="col-md-4 col-item right" data-aos="fade-left" data-aos-easing="linear"
            data-aos-duration="500">
                <div class="row item-wrap">
                    <div class="col-12 item__inner">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{$home[14]['image'] }}" alt="" class="svg">
                            </div>
                            <div class="col-9">
                                <h3 class="small-title">{!! strip_tags($home[14]['content']) !!}</h3>
                                <p>{!! strip_tags($home[15]['content']) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 item__inner">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{$home[16]['image'] }}" alt="" class="svg">
                            </div>
                            <div class="col-9">
                                <h3 class="small-title">{!! strip_tags($home[16]['content']) !!}</h3>
                                <p>{!! strip_tags($home[17]['content']) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 item__inner">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{$home[18]['image'] }}" alt="" class="svg">
                            </div>
                            <div class="col-9">
                                <h3 class="small-title">{!! strip_tags($home[18]['content']) !!}</h3>
                                <p>{!! strip_tags($home[19]['content']) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="map-wrap">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas"
                        src="{!! strip_tags($contact[2]['content'])!!}"></iframe>
                    <a href='https://www.add-map.net/'>how to add google maps to my website</a>
                    <script type='text/javascript'
                        src='https://embedmaps.com/google-maps-authorization/script.js?id=11077fd57198036909304a1d75cb40aec82cc936'></script>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 address">
                <h4 class="title">{!! strip_tags($contact[3]['content'])!!}</h4>
                <p class="detail">{!! strip_tags($contact[4]['content'])!!}
                    </p>
                <div class="icon-box">
                    <img src="{{ asset('website/img/phone-call.svg') }}" alt="phone" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($contact[5]['content'])!!}</p>
                    </div>
                </div>
                <div class="icon-box">
                    <img src="{{ asset('website/img/mail.svg') }}" alt="phone" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($contact[6]['content'])!!}</p>
                    </div>
                </div>
                <div class="icon-box">
                    <img src="{{ asset('website/img/mail.svg') }}" alt="phone" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($contact[7]['content'])!!}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 address">
                <h4 class="title">{!! strip_tags($contact[8]['content'])!!}</h4>
                <p class="detail">{!! strip_tags($contact[9]['content'])!!}
                    </p>
                <div class="icon-box">
                    <img src="{{ asset('website/img/phone-call.svg') }}" alt="phone" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($contact[10]['content'])!!}</p>
                    </div>
                </div>
                <div class="icon-box">
                    <img src="{{ asset('website/img/mail.svg') }}" alt="phone" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($contact[11]['content'])!!}</p>
                    </div>
                </div>
                <div class="icon-box">
                    <img src="{{ asset('website/img/mail.svg') }}" alt="phone" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($contact[12]['content'])!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

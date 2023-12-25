<div class="footer-location">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 col-item">
                <h4>{!! strip_tags($content[0]['content']) !!}</h4>
                <div class="icon-box">
                    <img src="{{ $content[1]['image'] }}" alt="" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($content[1]['content']) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-item">
                <h4>{!! strip_tags($content[2]['content']) !!}</h4>
                <div class="icon-box">
                    <img src="{{ $content[3]['image'] }}" alt="" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($content[3]['content']) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-item">
                <h4>{!! strip_tags($content[4]['content']) !!}</h4>
                <div class="icon-box">
                    <img src="{{ $content[5]['image'] }}" alt="" class="svg">
                    <div class="content__address">
                        <p>{!! strip_tags($content[5]['content']) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

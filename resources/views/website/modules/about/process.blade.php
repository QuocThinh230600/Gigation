<section class="process">
    <div class="container">
        <h3 class="title-section">{!! strip_tags($about[6]['content']) !!}</h3>
        <div class="row process-wrap">
            <div class="col-12 col-lg-6 process__item">
                <p><strong>{!! strip_tags($about[7]['content']) !!}</strong></p>
                <p>{!! strip_tags($about[8]['content']) !!}</p>
            </div>
            <div class="col-12 col-lg-6 process__item">
                <img src="{{$image_process->image}}" onerror="this.src='{{$error_image}}'" alt="">
            </div>
        </div>
        <div class="row process-wrap">
            <div class="col-12 col-lg-6 process__item">
                <img src="{{$image_process1->image}}" onerror="this.src='{{$error_image}}'" alt="">
            </div>
            <div class="col-12 col-lg-6 process__item">
                <p><strong>{!! strip_tags($about[9]['content']) !!}</strong></p>
                <p>{!! strip_tags($about[10]['content']) !!}</p>
            </div>
        </div>
    </div>
</section>
<section class="about">
    <div class="container">
        <h3 class="title-section">{!! strip_tags($about[2]['content']) !!}</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <p><strong>{!! strip_tags($about[3]['content']) !!}</strong></p>
                <p>{!! strip_tags($about[4]['content']) !!}</p>
                <p>{!! strip_tags($about[5]['content']) !!}</p>
            </div>
            <div class="col-12 col-md-6">

            <img src="{{ $image_top->image }}"  onerror="this.src='{{$error_image}}'" alt="">

               
            </div>
        </div>
    </div>
</section>
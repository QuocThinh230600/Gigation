<section class="hero data-bg"
data-bg-src="{{$image_banner->image}}"  onerror="this.src='{{$error_image}}'">
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="title">{!! strip_tags($about[0]['content']) !!}</h1>
            <p>{!! strip_tags($about[1]['content']) !!}</p>
        </div>
    </div>
</div>
</section>
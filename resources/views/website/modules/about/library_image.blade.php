<section class="library-images">
    <div class="container">
        <h3 class="title-section">Thư viện hình ảnh</h3>
        <div class="headline">
            <div class="title">
                <h3>HÌNH ẢNH</h3>
            </div>
            <!-- <div class="view-all">
                <a href="">Xem tất cả<svg xmlns="http://www.w3.org/2000/svg" width="5.251" height="8.504"
                        viewBox="0 0 5.251 8.504" class="svg replaced-svg">
                        <path id="arrow-next" d="M13.884,9l-1,1,3.246,3.253L12.885,16.5l1,1,4.252-4.252Z"
                            transform="translate(-12.885 -9)" fill="#4d4d4d"></path>
                    </svg>
                </a>
            </div> -->
        </div>
        <div class="gallery-images">
            @foreach ($image_gallery as $item)
            <div class="img-wrap">
                <a data-fancybox="gallery" href="{{$item->image}}" onerror="this.src='{{$error_image}}'">
                    <img src="{{$item->image}}" onerror="this.src='{{$error_image}}'" alt="">
                </a>
            </div>
            @endforeach
        </div>
        <div class="headline">
            <div class="title">
                <h3>VIDEO</h3>
            </div>
            <!-- <div class="view-all">
                <a href="">Xem tất cả<svg xmlns="http://www.w3.org/2000/svg" width="5.251" height="8.504"
                        viewBox="0 0 5.251 8.504" class="svg replaced-svg">
                        <path id="arrow-next" d="M13.884,9l-1,1,3.246,3.253L12.885,16.5l1,1,4.252-4.252Z"
                            transform="translate(-12.885 -9)" fill="#4d4d4d"></path>
                    </svg>
                </a>
            </div> -->
        </div>
        <div class="gallery-videos">
            <div class="video-wrap">
                <iframe width="560" height="315" src="{!! strip_tags($video[0]['content']) !!}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="video-wrap">
                <iframe width="560" height="315" src="{!! strip_tags($video[1]['content']) !!}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="video-wrap">
                <iframe width="560" height="315" src="{!! strip_tags($video[2]['content']) !!}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="video-wrap">
                <iframe width="560" height="315" src="{!! strip_tags($video[3]['content']) !!}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
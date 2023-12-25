    <div class="col-12 col-lg-8 col-left">
        <h1 class="post-title">{{$newdetail->title}}</h1>
        <ul class="meta__tag">
            <li><a href="" class="post-author">By {{$newdetail->author}}</a></li>
            <li><a href="" class="post-date">{{$newdetail->created_at}}</a></li>
        </ul>
        <img src="{{$newdetail->image}}" alt="">
        <p>{!! strip_tags($newdetail->intro) !!}</p>
        <p>{!! strip_tags($newdetail->content) !!}</p>
        <div class="share-box">
            <span class="share__title">SHARE</span>
            <div class="social-sharing">

                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=371043137548372&autoLogAppEvents=1" nonce="1hrZD9U1"></script>
                
                <div class="fb-share-button" data-href="{{$newdetail->slug}}" data-layout="button_count" data-size="small"><a target="_blank" 
                    href="https://www.facebook.com/sharer/sharer.php?u={{$newdetail->slug}}" 
                    class="fb-xfbml-parse-ignore">Chia sẻ</a>
                </div>
                {{-- <a href="" class="social__icon social__facebook">
                    <img class="svg" src="{{asset('website/img/facebook-icon.svg')}}" alt="">
                    <div class="td-social-but-text">Facebook</div>
                </a> --}}


                {{-- <a href="" class="social__icon social__twitter">
                    <img class="svg" src="{{asset('website/img/facebook-icon.svg')}}" alt="">
                    <div class="td-social-but-text">Twitter</div>
                </a> --}}
            </div>
        </div>

        <div class="prev-next-post">
            <div class="row">
                <div class="col-6 left">
                    @if ($newprev != null)
                        <p>Bài viết trước</p>
                        <a href="{{route('new_detail', $newprev->slug)}}">{{$newprev->title}}</a>
                    @endif
                </div>
                <div class="col-6 right">
                    @if ($newnext != null)
                        <p>Bài viết sau</p>
                        <a href="{{route('new_detail', $newnext->slug)}}">{{$newnext->title}}</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="featured-news-fluid discovery-news">
            <div class="news-container">
                <div class="title">
                    <h3 class="title__large active" data-tab="tab1">Tin liên quan</h3>
                    <h3 class="title__large" data-tab="tab2">Tin cùng tác giả</h3>
                    <div class="entry-arrow-btn">
                        <div class="prev-btn">
                            <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                        </div>
                        <div class="next-btn">
                            <img src="{{asset('website/img/prev.svg')}}" alt="" class="svg">
                        </div>
                    </div>
                </div>

                <div class="featured-news-carousel active" id="tab1">
                    @foreach ($newsCategory as $key => $newsC)
                        @if ($key % 6 == 0)
                            <div class="carousel-cell">
                        @endif

                        @if ($key % 3 == 0)
                            <div class="news-wrap news-row">
                        @endif

                            <div class="news__item-wrap">
                                <div class="item">
                                    <div class="img">
                                        <a href="{{route('new_detail',$newsC->slug)}}"><img src="{{$newsC->image}}" alt=""></a>
                                    </div>
                                    <h4 class="entry-title"><a href="{{route('new_detail',$newsC->slug)}}">{{$newsC->title}}</a></h4>
                                </div>
                            </div>

                        @if ($key % 3 == 2)
                            </div>
                        @endif

                        @if ($key % 6 == 5)
                            </div>
                        @endif
                    @endforeach
                        @if ($key % 3 != 2)
                            </div>
                        @endif
                        @if ($key % 6 != 5)
                            </div>
                        @endif
                </div>

                <div class="featured-news-carousel" id="tab2">
                    @foreach ($newsAuthor as $key => $newsA)
                        @if ($key % 6 == 0)
                            <div class="carousel-cell">
                        @endif

                        @if ($key % 3 == 0)
                            <div class="news-wrap news-row">
                        @endif
                            <div class="news__item-wrap">
                                <div class="item">
                                    <div class="img">
                                        <a href="{{route('new_detail',$newsA->slug)}}"><img src="{{$newsA->image}}" alt=""></a>
                                    </div>
                                    <h4 class="entry-title"><a href="{{route('new_detail',$newsA->slug)}}">{{$newsA->title}}</a></h4>
                                </div>
                            </div>

                        @if ($key % 3 == 2)
                            </div>
                        @endif

                        @if ($key % 6 == 5)
                            </div>
                        @endif
                    @endforeach
                        @if ($key % 3 != 2)
                            </div>
                        @endif
                        @if ($key % 6 != 5)
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>

<div class="hero-news__row">
    @php
        $check = true;
    @endphp
    @foreach ($GetNewsCommerces as $GetNewsCommerce)
        @if ($check) 
            <div class="news-item">
                <a href="{{route('new_detail', $GetNewsCommerce->slug)}}">
                    <img src="{{$GetNewsCommerce->image}}" alt="">
                </a>
                <div class="meta-info-container">
                    <ul class="meta__tag">
                        <li>
                            <a href="" class="post-category">
                                @foreach ($GetNewsCommerce->category()->get() as $item)
                                    @php
                                        echo $item->name;
                                        break;
                                    @endphp
                                @endforeach
                            </a>
                    </li>
                        <li><a href="" class="post-author">By {{$GetNewsCommerce->author}}</a></li>
                        <li><a href="" class="post-date">{{$GetNewsCommerce->created_at}}</a></li>
                    </ul>
                    <h3 class="entry-title">{{$GetNewsCommerce->title}}</h3>
                </div>
            </div>
            @php
                $check = false;
            @endphp
        @else
            <div class="news-item item-secondary">
                <a href="{{route('new_detail', $GetNewsCommerce->slug)}}">
                    <img src="{{$GetNewsCommerce->image}}" alt="">
                </a>
                <div class="meta-info-container">
                    <ul class="meta__tag">
                        <li><a href="" class="post-category">
                            @foreach ($GetNewsCommerce->category()->get() as $item)
                                @php
                                    echo $item->name;
                                    break;
                                @endphp
                            @endforeach
                        </a></li>
                        <li><a href="" class="post-author">By {{$GetNewsCommerce->author}}</a></li>
                        <li><a href="" class="post-date">{{$GetNewsCommerce->created_at}}</a></li>
                    </ul>
                    <h3 class="entry-title">{{$GetNewsCommerce->title}}</h3>
                </div>
            </div>
        @endif
    @endforeach
    
</div>
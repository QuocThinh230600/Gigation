
        <section class="advantages">
            <div class="container">
                <h4 class="title">Ưu điểm vượt trội</h4>
                <div class="row">
                    @foreach ($category->advantages()->where('position', 11)->get() as $item)
                    <div class="col-12 col-lg-4">
                        <div class="inner-item">
                            <img class="svg" src="{{$item->image}}" alt="">
                            <h5 class="item__title">{!!strip_tags($item->title)!!}</h5>
                            <p class="item__desc">{!!strip_tags($item->content)!!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

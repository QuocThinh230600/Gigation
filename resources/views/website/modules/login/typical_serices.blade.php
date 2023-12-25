<div class="typical-serices">
    <h5>Dịch vụ tiêu biểu</h5>
    <ul class="list-service">
        @foreach ($category as $item)
        <li class="icon__service">
            <a href="{{route('category', $item->slug)}}"><img src="{{$item->image}}" alt=""></a>
        </li>
        @endforeach
    </ul>
</div>

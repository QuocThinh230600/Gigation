@if ($paginator->lastPage() > 1)
    <div class="pagination-row">
        <ul class="paginate">
            <li><a href="{{$paginator->url(1)}}"> < </a></li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li><a href="{{$paginator->url($i)}}" class="{{$paginator->currentPage() == $i ?'active':''}}">{{$i}}</a></li>
            @endfor
            <li><a href="{{$paginator->url($paginator->lastPage())}}"> > </a></li>
        </ul>
        <div class="desc">
            <p>page <span>{{$paginator->currentPage()}}</span> of <span>{{$paginator->lastPage()}}</span></p>
        </div>
    </div>
@endif
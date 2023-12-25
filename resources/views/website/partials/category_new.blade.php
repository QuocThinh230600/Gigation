<div class="category-wrap">
    <div class="right__title">
        <h3 class="title__large">Danh mục</h3>
    </div>
    <ul class="cate__list">
        @foreach ($categorys as $category)
            <li><a href="{{ route('newtype', $category->slug) }}">{{$category->name}}<span>
                {{$category->news()->count()}}
            </span></a></li> 
        @endforeach
    </ul>
</div>
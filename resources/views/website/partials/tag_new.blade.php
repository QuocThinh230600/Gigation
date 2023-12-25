<div class="tags-wrap">
    <div class="right__title">
        <h3 class="title__large">Danh mục</h3>
    </div>
    <div class="cloud-tags">
        @foreach ($categorys as $category)
            <a href="{{route('newtype', $category->slug)}}" class="tag__link">{{$category->title_tag}}</a>
        @endforeach
    </div>
</div>
 
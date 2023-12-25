<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            @can('news_edit')
                <a href="{{ route('admin.news.edit', ['news' => $uuid]) }}" class="dropdown-item text-info"><i class="icon-pencil"></i> {{ behavior('action.edit') }}</a>
            @endcan

            @can('news_destroy')
                <a href="{{ route('admin.news.destroy', ['news' => $uuid]) }}" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> {{ behavior('action.delete') }}</a>
            @endcan

            @if (config('app.multi_language'))
                @can('category_create')
                    @php
                        $translate = $news->translateRemaining($uuid)
                    @endphp

                    @if ($translate["full"])
                        <a class="dropdown-item"><i class="icon-earth"></i>{{ behavior('action.language') }} {!! $translate['language'] !!}</a>
                    @else
                        <a href="{{ route('admin.news.language', ['news' => $uuid]) }}" class="dropdown-item"><i class="icon-earth"></i>{{ behavior('action.language') }} {!! $translate['language'] !!}</a>
                    @endif
                @endcan
            @endif

        </div>
    </div>
</div>

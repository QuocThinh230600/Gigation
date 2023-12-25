<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            @can('image_edit')
                <a href="{{ route('admin.image.edit', ['image' => $uuid]) }}" class="dropdown-item text-info"><i class="icon-pencil"></i> {{ behavior('action.edit') }}</a>
            @endcan

            {{-- @can('image_destroy')
                <a href="{{ route('admin.image.destroy', ['image' => $uuid]) }}" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> {{ behavior('action.delete') }}</a>
            @endcan --}}

            @if (config('app.multi_language'))
                @can('image_create')
                    @php
                        $translate = $images->translateRemaining($uuid)
                    @endphp

                    @if ($translate["full"])
                        <a class="dropdown-item"><i class="icon-earth"></i>{{ behavior('action.language') }} {!! $translate['language'] !!}</a>
                    @else
                        <a href="{{ route('admin.image.language', ['image' => $uuid]) }}" class="dropdown-item"><i class="icon-earth"></i>{{ behavior('action.language') }} {!! $translate['language'] !!}</a>
                    @endif
                @endcan
            @endif

        </div>
    </div>
</div>

<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            @can('product_edit')
                <a href="{{ route('admin.product.edit', ['product' => $uuid]) }}" class="dropdown-item text-info"><i class="icon-pencil"></i> {{ behavior('action.edit') }}</a>
            @endcan

            @can('product_destroy')
                <a href="{{ route('admin.product.destroy', ['product' => $uuid]) }}" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> {{ behavior('action.delete') }}</a>
            @endcan

            @if (config('app.multi_language'))
                @can('category_create')
                    @php
                        $translate = $product->translateRemaining($uuid)
                    @endphp

                    @if ($translate["full"])
                        <a class="dropdown-item"><i class="icon-earth"></i>{{ behavior('action.language') }} {!! $translate['language'] !!}</a>
                    @else
                        <a href="{{ route('admin.product.language', ['product' => $uuid]) }}" class="dropdown-item"><i class="icon-earth"></i>{{ behavior('action.language') }} {!! $translate['language'] !!}</a>
                    @endif
                @endcan
            @endif

        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-transparent border-bottom header-elements-inline">

        <h6 class="card-title">{{ $title }}</h6>

        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="fullscreen"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    @if ($table)
        {{ $slot }}
    @else
        <div class="card-body" {{ $attrId }}>
            {{ $slot }}
        </div>
    @endif
</div>

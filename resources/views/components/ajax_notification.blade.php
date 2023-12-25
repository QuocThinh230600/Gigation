
<li class="media unread">
    <div class="mr-3 position-relative">
        <img src="{{ $avatar ?? asset(GLOBAL_ASSETS_IMG . 'avatar.svg') }}" width="36" height="36" class="rounded-circle" alt="">
    </div>

    <div class="media-body">
        <div class="media-title">
            <a href="{{ $link ?? '#' }}">
                <span class="font-weight-semibold">{{ $type ?? '' }}</span>
                <span class="badge badge-pill badge-mark bg-orange-400 border-orange-400 ml-5"></span>
                <span class="text-muted float-right font-size-sm">{{ \Carbon\Carbon::now()->format('H:i') }}</span>
            </a>
        </div>
        <span class="text-muted">{{ $message }}</span>
    </div>
</li>



<div class="dropdown-content-body dropdown-scrollable">
    <ul class="media-list" data-url="{{route('admin.ajax.MakeAsReadNoti')}}">
        @foreach (auth()->user()->unreadNotifications as $notification)
            <li class="media {{$notification->read_at == NULL ? 'unread' : 'read'}}" data-id="{{$notification->id}}">
                <div class="mr-3 position-relative">
                    <img src="{{ $notification->data['avatar'] ?? asset(GLOBAL_ASSETS_IMG . 'avatar.svg') }}" width="36" height="36" class="rounded-circle" alt="">
                </div>
                <div class="media-body">
                    <div class="media-title">
                        <a href="{{ $notification->data['link'] ?? '#' }}">
                            <span class="font-weight-semibold">{{ $notification->data['type'] ?? '' }}</span>
                            @if ($notification->read_at == NULL)
                                <span class="badge badge-pill badge-mark bg-orange-400 border-orange-400 ml-5"></span>
                            @endif
                            <span class="text-muted float-right font-size-sm">{{ \Carbon\Carbon::parse($notification->created_at)->format('H:i') }}</span>
                        </a>
                    </div>
                    <span class="text-muted">{{ $notification->data['message'] }}</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
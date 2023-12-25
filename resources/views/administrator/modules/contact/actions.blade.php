<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            @can('contact_reply')
                <a href="{{ route('admin.contact.reply', ['contact' => $uuid]) }}" class="dropdown-item text-info"><i class="icon-pencil"></i> {{ behavior('action.reply') }}</a>
            @endcan

            @can('contact_destroy')
                <a href="{{ route('admin.contact.destroy', ['contact' => $uuid]) }}" class="dropdown-item accept_delete text-danger"><i class="icon-trash"></i> {{ behavior('action.delete') }}</a>
            @endcan

        </div>
    </div>
</div>

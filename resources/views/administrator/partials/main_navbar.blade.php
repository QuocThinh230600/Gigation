<div class="navbar navbar-expand-md navbar-light navbar-static">
    <div class="navbar-brand" style="padding:13px 0px 10px 0px">
        <a href="{{ route('admin.dashboard') }}" class="d-inline-block">
            <h5 class="mb-0 font-weight-bold text-white">{{ config('app.name') }}</h5>
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">

                <a href="/" class="navbar-nav-link">
                    <i class="icon-home2 pr-1"></i> {{ label('navbar.homepage') }}
                </a>
            </li>

            @if (config('app.multi_language'))
            <ul class="navbar-nav">
                <li class="nav-item dropdown language-switch">
                    <a class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $language_current->flag }}" class="img-flag mr-2" alt="{{ $language_current->name }}"> {{ $language_current->name }}
                    </a>

                    <div class="dropdown-menu">
                        @foreach ($language as $lang)
                            <a href="{{ route('admin.locale',['locale' => $lang->locale]) }}" class="dropdown-item english">
                                <img src="{{ $lang->flag }}" class="img-flag mr-2" alt="{{ $lang->name }}">
                                {{ $lang->name }}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
            @endif

            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-bell2"></i>
                    <span class="d-md-none ml-2">Notifications</span>
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0 notification_count">{{count(auth()->user()->unreadNotifications) ?? 0}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Thông báo</span>
                        {{-- <a href="#" class="text-default"><i class="icon-compose"></i></a> --}}
                    </div>

                    @include('administrator.partials.notification')

                    {{-- <div class="dropdown-content-footer justify-content-center p-0">
                        <a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="" data-original-title="Load more"><i class="icon-menu7 d-block top-0"></i></a>
                    </div> --}}
                </div>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img class="rounded-circle mr-2" height="34" width="34" src="{{ auth()->user()->avatar ?? asset(GLOBAL_ASSETS_IMG . 'avatar.svg') }}">
                    <span>{{ auth()->user()->full_name ?? auth()->user()->email }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.personal.show') }}" class="dropdown-item">
                        <i class="icon-user-plus"></i> {{ label('navbar.my_profile') }}
                    </a>
                    <div class="dropdown-divider"></div>

                    @canany(['config_edit'])
                    <a href="{{ route('admin.config.edit') }}" class="dropdown-item">
                        <i class="icon-cog5"></i> {{ label('navbar.config_system') }}
                    </a>
                    @endcanany

                    <a id="logout" href="{{ route('auth.logout') }}" class="dropdown-item">
                        <i class="icon-switch2"></i> {{ label('navbar.logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>

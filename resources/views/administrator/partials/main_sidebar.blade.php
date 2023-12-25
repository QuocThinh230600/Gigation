<!-- Main sidebar -->
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-1 mt-1">
                        <a href="#">
                            <img class="rounded-circle" height="44" width="44" src="{{ auth()->user()->avatar ?? asset(GLOBAL_ASSETS_IMG . 'avatar.svg') }}">
                        </a>
                    </div>

                    <div class="media-body ml-2">
                        <div class="media-title font-weight-semibold">{{ auth()->user()->full_name ?? auth()->user()->email  }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-calendar font-size-sm"></i> <span class="show_clock"></span>
                        </div>
                        <div class="font-size-xs opacity-50 mt-1">
                            <i class="icon-location3 font-size-sm"></i> {{ get_client_ip() }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('admin.personal.show') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="icon-home4"></i>
                        <span>
                            {{ module('dashboard')  }}
                        </span>
                    </a>
                </li>

                @foreach (menu($roles) as $name_group => $data_menu)


                    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{ module($name_group) }}</div> <i class="icon-menu" title="Main"></i></li>

                    @foreach ($data_menu as $menu)
                        @if ($menu["status"])
                            <li class="nav-item nav-item-submenu {{ (request()->is('admin/'.$menu["module"]) || request()->is('admin/'.$menu["module"].'/*')) ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="" class="nav-link"><i class="{{ $menu["icon"] }}"></i> <span>{{ $menu["name"] }}</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="{{ $menu["name"] }}">
                                    @foreach ($menu["action"] as $submenu)
                                        @if ($submenu["status"])
                                            <li class="nav-item"><a href="{{ route($submenu["route"]) }}" class="nav-link {{ request()->is($submenu["request"]) ? 'active' : '' }}">{{ $submenu["name"] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->

<!-- Secondary sidebar -->
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-secondary-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Secondary sidebar</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar tabs -->
        <div class="sortable">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                <li class="nav-item">
                    <a href="#components-tab" class="nav-link active" data-toggle="tab">
                        <i class="icon-grid-alt"></i>
                    </a>
                </li>

                <li class="nav-item d-none">
                    <a href="#forms-tab" class="nav-link" data-toggle="tab">
                        <i class="icon-menu6"></i>
                    </a>
                </li>

                <li class="nav-item dropdown d-none">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-grid5"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#other-tab" class="dropdown-item" data-toggle="tab"><i class="icon-task"></i> Other elements</a>
                        <a href="#custom-tab" class="dropdown-item" data-toggle="tab"><i class="icon-googleplus5"></i> Custom content</a>
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active show" id="components-tab">

                    <!-- Block buttons -->
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom border-bottom-light header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">{{ label('navbar.module') }}</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('admin.user.index') }}" class="btn bg-teal-400 btn-block btn-float">
                                        <i class="icon-people icon-2x"></i>
                                        <span>{{ mbUcFirst(trans('module.user')) }}</span>
                                    </a>

                                    <a href="{{ route('admin.category.index') }}" class="btn bg-pink-400 btn-block btn-float">
                                        <i class="icon-database icon-2x"></i>
                                        <span>{{ mbUcFirst(trans('module.category')) }}</span>
                                    </a>
                                </div>

                                <div class="col">
                                    <a href="{{ route('admin.role.index') }}" class="btn bg-blue-400 btn-block btn-float">
                                        <i class="icon-shield2 icon-2x"></i>
                                        <span>{{  mbUcFirst(trans('module.role')) }}</span>
                                    </a>

                                    <a href="{{ route('admin.news.index') }}" class="btn bg-orange-400 btn-block btn-float">
                                        <i class="icon-clipboard6 icon-2x"></i>
                                        <span>{{  mbUcFirst(trans('module.news')) }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /block buttons -->

                    <!-- Light buttons tile -->
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom border-bottom-light header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">{{ label('navbar.social') }}</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row row-tile no-gutters">
                                <div class="col-6">
                                    <a href="https://facebook.com" target="_blank" class="btn btn-light border-light-alpha btn-block btn-float border-top-0 border-left-0 m-0">
                                        <i class="icon-facebook2 text-primary-600 icon-2x"></i>
                                        <span>Facebook</span>
                                    </a>

                                    <a href="https://youtube.com" target="_blank" class="btn btn-light border-light-alpha btn-block btn-float m-0 border-bottom-0 border-left-0">
                                        <i class="icon-youtube text-danger-400 icon-2x"></i>
                                        <span>Youtube</span>
                                    </a>
                                </div>

                                <div class="col-6">
                                    <a href="https://google.com.vn" target="_blank" class="btn btn-light border-light-alpha btn-block btn-float m-0 border-top-0 border-right-0">
                                        <i class="icon-google text-pink-400 icon-2x"></i>
                                        <span>Google</span>
                                    </a>

                                    <a href="https://drive.google.com/drive/my-drive" target="_blank" class="btn btn-light border-light-alpha btn-block btn-float m-0 border-bottom-0 border-right-0">
                                        <i class="icon-google-drive text-success-400 icon-2x"></i>
                                        <span>Google Drive</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /light buttons tile -->
                </div>

                <div class="tab-pane fade" id="forms-tab">
                    <!-- Sidebar search -->
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom border-bottom-light header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Sidebar search</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="#">
                                <div class="form-group-feedback form-group-feedback-right">
                                    <input type="search" class="form-control" placeholder="Search">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4 font-size-base text-muted"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /sidebar search -->

                </div>

                <div class="tab-pane fade" id="other-tab">

                    <!-- Closable section -->
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom border-bottom-light header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Closable section</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="remove"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="list mb-0 pl-3">
                                <li>It wasn't actually a dream</li>
                                <li>A collection of textile samples</li>
                                <li>I've got the money together</li>
                            </ul>
                        </div>
                    </div>
                    <!-- /closable section -->

                </div>

                <div class="tab-pane fade" id="custom-tab">

                    <!-- User list -->
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom border-bottom-light header-elements-inline">
                            <span class="text-uppercase font-size-sm font-weight-semibold">Media list</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="mr-3">
                                        <img src="{{ asset(GLOBAL_ASSETS_IMG.'placeholders/placeholder.jpg') }}" width="36" height="36" class="rounded-circle" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="#" class="media-title text-white font-weight-semibold">James Alexander</a>
                                        <div class="font-size-sm text-muted">Santa Ana, CA.</div>
                                    </div>
                                    <div class="ml-3 align-self-center">
                                        <span class="badge badge-mark border-success"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /user list -->

                </div>
            </div>
        </div>
    </div>
    <!-- /sidebar content -->

</div>
<!-- /secondary sidebar -->

<div class="page-header border-bottom-0">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
            <a href="{{ URL::previous() }}"><i class="icon-arrow-left52 mr-2"></i></a>
                <span class="font-weight-semibold">@yield('module')</span> - @yield('action')
                <small class="d-block">@yield('title')</small>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            @hasSection('create')
            <a href="@yield('create')" class="btn btn-labeled btn-labeled-right bg-primary">{{ behavior('action.create') }} <b><i class="icon-database-add"></i></b></a>
            @endif

            @hasSection('index')
            <a href="@yield('index')" class="btn btn-labeled btn-labeled-right bg-primary">{{ behavior('action.index') }} <b><i class="icon-drawer3"></i></b></a>
            @endif
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="breadcrumb-line breadcrumb-line-component border-0 header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ module('dashboard') }}</a>
                <a href="" class="breadcrumb-item">@yield('module')</a>
                <span class="breadcrumb-item active">@yield('action')</span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="#" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    {{ label('navbar.support') }}
                </a>
            </div>
        </div>
    </div>
</div>

<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('administrator.partials.main_navbar', 'App\View\Composers\NavbarComposer');
        View::composer('administrator.partials.main_sidebar', 'App\View\Composers\MainSideBarComposer');
        View::composer('website.partials.category_new', 'App\View\Composers\NewsMenuComposer');
        View::composer('website.partials.nomination_new', 'App\View\Composers\NominationNewsComposer');
        View::composer('website.partials.tag_new', 'App\View\Composers\CloudTagsComposer');
        View::composer('website.partials.header_menu_new', 'App\View\Composers\HeaderMenuNewsComposer');
        View::composer('website.partials.header', 'App\View\Composers\headerMainMenuComposer');
        View::composer('website.partials.footer_location', 'App\View\Composers\FooterLocationComposer');
        View::composer('website.partials.footer_bottom', 'App\View\Composers\FooterBottomComposer');
        View::composer('website.partials.contact_footer', 'App\View\Composers\FooterContactComposer');
        View::composer('website.partials.float_button', 'App\View\Composers\FloatButtonComposer');
        View::composer('website.partials.main_footer', 'App\View\Composers\MainFooterComposer');
        View::composer('website.partials.nav_menu_mobile', 'App\View\Composers\NavMenuMobileComposer');
        View::composer('website.partials.head', 'App\View\Composers\headComposer');
        View::composer('website.partials.header_banner_new', 'App\View\Composers\headerBannerNewComposer');
        View::composer('website.master', 'App\View\Composers\MasterComposer');
    }
}

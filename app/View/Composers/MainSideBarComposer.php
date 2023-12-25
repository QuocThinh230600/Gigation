<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MainSideBarComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $roles = auth()->user()->getAllPermissions()->pluck('name')->toArray();

        $view->with('roles', $roles);
    }
}

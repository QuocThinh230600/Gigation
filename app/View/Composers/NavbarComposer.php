<?php

namespace App\View\Composers;

use App\Repositories\Language\LanguageRepository;
use Illuminate\View\View;

class NavbarComposer
{
    protected $language;

    /**
     * Create a new profile composer.
     *
     * @param LanguageRepository $language
     * @return void
     */
    public function __construct(LanguageRepository $language)
    {
        $this->language = $language;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $language_current = $this->language->checkLanguageCurrent();

        $language = $this->language->getAllWithStatusOn();

        $view->with('language_current', $language_current);

        $view->with('language', $language);
    }
}

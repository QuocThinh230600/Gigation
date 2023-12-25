<?php

namespace App\View\Composers;

use App\Repositories\News\NewsRepository;
use Illuminate\View\View;

class NominationNewsComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $news;

    public function __construct(NewsRepository $news)
    {
        $this->news = $news;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $News   = $this->news->getAllNews()->take(3)->get();

        $view->with('News', $News);
    }

}

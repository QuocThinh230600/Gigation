<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Content\ContentRepository;

class FooterLocationComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $content;

    public function __construct(ContentRepository $content)
    {
        $this->content = $content;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $content = $this->content->getContentWithPage(6);

        $view->with('content', $content);
    }

}

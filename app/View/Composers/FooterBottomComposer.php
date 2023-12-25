<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Content\ContentRepository;

class FooterBottomComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $content;

    public function __construct(ContentRepository $content, ConfigRepository $config)
    {
        $this->content = $content;
        $this->config  = $config;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $content = $this->content->getContentWithPage(7);
        $config = $this->config->get_all_config();

        $view->with('content', $content)->with('config', $config);
    }

}

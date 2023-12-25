<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Content\ContentRepository;

class headerMainMenuComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $category;
    private $config;
    private $content;

    public function __construct(CategoryRepository $category, ConfigRepository $config, ContentRepository $content)
    {
        $this->category = $category;
        $this->config = $config;
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
        $config = $this->config->getById(23);
        $content = $this->content->getContentWithPage(15);

        $categorys   = $this->category->getAllCategoryRecursiveProduct(8);

        $view->with('categorys', $categorys)->with('config', $config)->with('content', $content);
    }

}

<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Image\ImageRepository;

class MainFooterComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $content;
    private $category;
    private $config;
    private $image;

    public function __construct(ContentRepository $content, CategoryRepository $category, ConfigRepository $config, ImageRepository $image)
    {
        $this->content = $content;
        $this->category = $category;
        $this->config = $config;
        $this->image = $image;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $category   = $this->category->getAllCategoryRecursiveProduct(8);
        $content = $this->content->getContentWithPage(10);
        $config = $this->config->getById(23);
        $image = $this->image->getImageWithPositionGet(5,1)->take(1);

        $view->with('image', $image);
        $view->with('config', $config);
        $view->with('content', $content);
        $view->with('category', $category);
    }

}

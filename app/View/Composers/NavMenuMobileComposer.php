<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Image\ImageRepository;

class NavMenuMobileComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $content;
    private $category;
    private $image;

    public function __construct(ContentRepository $content, CategoryRepository $category, ImageRepository $image)
    {
        $this->content = $content;
        $this->category = $category;
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
        $image = $this->image->getImageWithPositionGet(5,1)->take(1);

        $view->with('image', $image);
        $view->with('category', $category);
    }

}

<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Category\CategoryRepository;

class CloudTagsComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categorys   = $this->category->getAllCategoryRecursiveProduct(2);

        $view->with('categorys', $categorys);
    }

}

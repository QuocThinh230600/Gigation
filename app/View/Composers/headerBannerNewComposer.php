<?php

namespace App\View\Composers;
use Illuminate\View\View;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Image\ImageRepository;

class headerBannerNewComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    private $config;
    private $image;

    public function __construct(ConfigRepository $config, ImageRepository $image)
    {
        $this->image = $image;
        $this->config = $config;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $image = $this->image->getImageWithPositionGet(8,1)->take(1);
        $config = $this->config->getById(23);

        $view->with('image', $image);
        $view->with('config', $config);
    }

}

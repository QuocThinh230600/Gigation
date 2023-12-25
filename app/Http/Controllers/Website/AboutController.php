<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Page\PageRepository;
use App\Repositories\Position\PositionRepository;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $view = 'website.modules.about';

    private $position;
    private $content;
    private $image;
    private $config;
    private $page;

    public function __construct(PositionRepository $position, ContentRepository $content, ImageRepository $image, ConfigRepository $config, PageRepository $page) {
        $this->position = $position;
        $this->content = $content;
        $this->image = $image;
        $this->page = $page;
        $this->config = $config;
    }

    public function index() {

        $config = $this->config->get_all_config();

        $data['error_image']    = $config['error_image'];
        $data['meta'] = $this->page->query()->where('id',3)->first();

        $data['image_top'] = $this->image->getImageWithPositionFirst(3,1);
        $data['image_process']  = $this->image->getImageWithPositionFirst(3,2);
        $data['image_process1']  = $this->image->getImageWithPositionFirst(3,3);
        $data['image_gallery'] = $this->image->getImageWithPositionGet(3,4)->take(8);
        $data['image_banner']  = $this->image->getImageWithPositionFirst(3,5);
        $data['image_client']  = $this->image->getImageWithPositionGet(3,6);

        $data['video'] = $this->content->getContentWithPage(4);

        $data['about'] = $this->content->getContentWithPage(3);

        return view($this->view.'.about_page',$data);
    }
}

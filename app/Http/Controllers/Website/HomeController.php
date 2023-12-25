<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Position\PositionRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $view = 'website.modules.homes';

    private $position;
    private $content;
    private $image;
    private $config;
    private $customer;
    private $category;
    private $page;

    public function __construct(
        PositionRepository $position,
        ContentRepository $content,
        ImageRepository $image,
        ConfigRepository $config,
        CustomerRepository $customer,
        CategoryRepository $category,
        PageRepository $page
    ) {
        $this->position = $position;
        $this->content = $content;
        $this->image = $image;
        $this->config = $config;
        $this->customer = $customer;
        $this->category = $category;
        $this->page = $page;
    }

    public function index()
    {
        $config = $this->config->get_all_config();

        $data['error_image']    = $config['error_image'];
        $data['category'] = $this->category->getAllCategoryByParent(8);

        $data['meta'] = $this->page->query()->where('id',1)->first();

        $data['home'] = $this->content->getContentWithPage(1);
        $data['image_top'] = $this->image->getImageWithPositionGet(2, 1);
        $data['image_client'] = $this->image->getImageWithPositionGet(2, 2)->take(4);
        $data['image_client1'] = $this->image->getImageWithPositionGet(2, 3)->take(4);
        $data['image_benefit'] = $this->image->getImageWithPositionGet(2, 4)->take(1);

        $data['customer'] = $this->customer->getAll();

        return view($this->view . '.home_page', $data);
    }
}

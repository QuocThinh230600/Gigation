<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $view = 'website.modules.contact';

    private $content;
    private $config;
    private $page;

    public function __construct(ContentRepository $content, ConfigRepository $config, PageRepository $page)
    {
        $this->content = $content;
        $this->config = $config;
        $this->page = $page;
    }

    public function index(){
        $config = $this->config->get_all_config();
        $data['meta'] = $this->page->query()->where('id',5)->first();

        $data['error_image']    = $config['error_image'];

        $data['contact'] = $this->content->getContentWithPage(5);

        return view($this->view.'.contact_page',$data);
    }
}

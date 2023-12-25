<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Repositories\News\NewsRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Http\Request;

class NewssController extends Controller
{
    private $new;
    private $page;

    function __construct(NewsRepository $news, PageRepository $page)
    {
        $this->news = $news;
        $this->page = $page;
    }

    public function index(){

        $data['meta'] = $this->page->query()->where('id',12)->first();
        $data['GetNewsCommerces']     = $this->news->getNewsWithCategory(5 , 3); //1
        $data['AllNews']              = $this->news->getAllNews()->take(5)->get(); //2
        $data['GetNews']              = $this->news->getNewsWithCategory(3 , 5);
        $data['GetNewsRecruitments']  = $this->news->getNewsWithCategory(4 , 5);
        $data['GetNewsNices']         = $this->news->getNewsWithCategory(6 , 5);
        $data['GetNewsKnowledges']    = $this->news->getNewsWithCategory(7 , 5);
        $data['GetNewsFeatureis']     = $this->news->getNewsWithFeatured(3 , 10);

        return view('website.modules.news.new_page_content',$data);
    }
}

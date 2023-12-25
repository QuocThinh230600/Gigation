<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $news;

    function __construct(NewsRepository $news)
    {
        $this->news   = $news;
    }
    
    public function searchnew(Request $request)
    {
        $data['key']     = $request->key;
        $data['Search']  = $this->news->SearchNews($data['key']);

        return view('website.modules.search_news.search_news_page', $data);
    }
}

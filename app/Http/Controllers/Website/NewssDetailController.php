<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\NewsTranslation;
use App\Repositories\Category\CategoryTranslationRepository;
use App\Repositories\News\NewsRepository;
use App\Repositories\News\NewsTranslationRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NewssDetailController extends Controller
{
   private $view = 'website.modules.';
   private $new;
   private $newsTrans;
   private $categoryTrans;
   private $page;

   function __construct(NewsRepository $news,
                        NewsTranslationRepository $newsTrans,
                        CategoryTranslationRepository $categoryTrans,
                        PageRepository $page)
   {
        $this->news          = $news;
        $this->newsTrans     = $newsTrans;
        $this->categoryTrans = $categoryTrans;
        $this->page = $page;
   }

   public function index($slug)
   {

    $data['meta'] = $this->page->query()->where('id',13)->first();
    $newID                  = $this->newsTrans->getIDNews($slug);
    $newIDPREV              = $newID - 1;
    $newIDNEXT              = $newID + 1;
    $data['newdetail']      = $this->news->getFirstNew($newID);
    $data['newprev']        = $this->news->getFirstNew($newIDPREV) ?? null;
    $data['newnext']        = $this->news->getFirstNew($newIDNEXT) ?? null;
    $categoryID             = $this->news->getNewsByNewsID($newID);
    $data['newsCategory']   = $this->news->getNewsByCategoryID($categoryID)->get();
    $data['CategoryB']      = $this->categoryTrans->getAllQuery()->where('category_id', '=', $categoryID)->first();
    $author                 = $this->newsTrans->getAuthor($slug);
    $data['newsAuthor']     = $this->newsTrans->getNewsWithAuthor($author)->get();
    
    $data['page_detail'] =  $this->news->getFirstNew($newID);

    return view($this->view .'new_detail.new_detail_page',$data);
  }
}

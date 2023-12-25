<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\NewsTranslation;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryTranslationRepository;
use App\Repositories\News\NewsRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NewTypeController extends Controller
{
    private $view = 'website.modules.';
    private $news;
    private $category;
    private $cagegoryTrans;
    private $page;

    function __construct(NewsRepository $news,
                         CategoryRepository $category,
                         CategoryTranslationRepository $categoryTrans,
                         PageRepository $page)
    {
        $this->news          = $news;
        $this->category      = $category;
        $this->page          = $page;
        $this->categoryTrans = $categoryTrans;
    }
    function index($slug){
        $data['meta'] = $this->page->query()->where('id',14)->first();
        $CateID                 = $this->categoryTrans->getIDCategory($slug);
        $data['newsTop']        = $this->news->getNewsByCategoryID($CateID)->take(3)->get();
        $arrayID = [];
        foreach($data['newsTop'] as $item) {
            $arrayID[] = $item->id;
        }

        
        $data['newsList']       = $this->news->getAllQuery()->whereHas('category', function (Builder $query) use ($CateID)  {
            $query->where('categories.id', '=', $CateID);
        })->whereNotIn('id', $arrayID)->paginate(3);

        $data['CateName']       = $this->categoryTrans->getNameCategory($slug);

        // $neww = [];
        // foreach($data['newsList'] as $item){
        //     $neww[] = $item;
        // }
        // $data['newsListUnset']  = array_splice($neww, 3);

        $data['page_detail'] =  $this->category->getById($CateID);

        return view($this->view .'new_type.new_type_page', $data);
    }
}

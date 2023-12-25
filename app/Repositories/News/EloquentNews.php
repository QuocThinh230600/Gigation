<?php

namespace App\Repositories\News;

use App\Models\News;
use App\Repositories\AbstractRepository;

class EloquentNews extends AbstractRepository implements NewsRepository
{
    protected $model;

    /**
     * EloquentNews constructor.
     * @param News $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(News $model)
    {
        $this->model = $model;
    }

    /**
     * Get new position in news
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getNewPosition(): int
    {
        $position = $this->model->max('position');

        return ($position == null) ? 1 : $position + 1;
    }

    /**
     * Get all data news with pivot category
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllNews(): object
    {
        return $this->model->with('category')->orderBy('created_at', 'DESC');
    }

    /**
     * Get data news with uuid
     * @param string $uuid
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getNewsUuid(string $uuid): array
    {
        $news     = $this->model->where('uuid', $uuid)->first();
        $category = $news->category_news()->pluck('category_id')->toArray();
        $images   = $news->news_images()->select('image','alt','position')->get();

        return [
            'news'     => $news,
            'category' => $category,
            'images'   => $images
        ];
    }

    /**
     * Get data news with cate_id and take
     * @param string $category_id, $take
     * @return array
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsWithCategory($category_id , $take)
    {
        return $this->model->whereHas('category_news', function ($query) use ($category_id){
            $query->where('category_id', $category_id);
        })->where('status','=', 4)->take($take)->get();
    }

    /**
     * Get data news with featured and take
     * @param string $featured, $take
     * @return array
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsWithFeatured($featured, $take)
    {
        return $this->model->whereHas('category_news', function ($query) use ($featured){
            $query->where('featured', $featured);
        })->where('status','=', 4)->take($take)->get();
    }

    /**
     * Get news by id
     * @param string $category_id
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsByCategoryID($category_id)
    {
        return $this->model->whereHas('category_news', function ($query) use ($category_id){
            $query->where('category_id', $category_id);
        })->where('status','=', 4);
    }

    

    /**
     * Get news detail
     * @param string $news_id
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getFirstNew($news_id)
    {
        return $this->model->with('news_translation')->where('id','=',$news_id)->first();
    }

    /**
     * Get news by id_news
     * @param string $id_news
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsByNewsID($news_id)
    {
        return $this->model::leftjoin('category_news', 'news.id', '=', 'category_news.news_id')->where('news.id', $news_id)->value('category_news.category_id');

    }
    
    /**
     * Get news with key
     * @param string $keys
     * @return array
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function SearchNews($key){
        return $this->model::LeftJoin('news_translations', 'news.id', '=', 'news_translations.news_id')->where('news_translations.title','LIKE', '%'. $key . '%')->get();
    }
}

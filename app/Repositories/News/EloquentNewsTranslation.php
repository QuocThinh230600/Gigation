<?php

namespace App\Repositories\News;

use App\Models\NewsTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentNewsTranslation extends AbstractTranslationRepository implements NewsTranslationRepository
{
    protected $model;

    /**
     * EloquentNewsTranslation constructor.
     * @param NewsTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(NewsTranslation $model)
    {
        $this->model = $model;
    }


    /**
     * get id category with slug
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getIDNews($slug)
    {   
        return $this->model->where('slug','=', $slug)->value('news_id');
    }

    /**
     * get author with slug
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getAuthor($slug)
    {   
        return $this->model->where('slug','=', $slug)->value('author');
    }

    /**
     * get news with author
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsWithAuthor($author)
    {   
        return $this->model->where('author','=', $author);
    }
}

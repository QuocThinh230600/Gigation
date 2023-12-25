<?php

namespace App\Repositories\Content;

use App\Models\Content;
use App\Repositories\AbstractRepository;

class EloquentContent extends AbstractRepository implements ContentRepository
{
    protected $model;

    /**
     * EloquentContent constructor.
     * @param Content $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Content $model)
    {
        $this->model = $model;
    }

    /**
     * Get content with page id
     * @param int $page_id
     * @return mixed
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getContentWithPage(int $page_id)
    {
        return $this->model->where('page_id',$page_id)->get();
    }

    /**
     * Get content with page id
     * @param int $page_id
     * @return mixed
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getContentAndPage(int $page_id)
    {
        return $this->model->with('page')->where('page_id',$page_id);
    }
}

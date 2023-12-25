<?php

namespace App\Repositories\Page;

use App\Models\Page;
use App\Repositories\AbstractRepository;

class EloquentPage extends AbstractRepository implements PageRepository
{
    protected $model;

    /**
     * EloquentPage constructor.
     * @param Page $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}

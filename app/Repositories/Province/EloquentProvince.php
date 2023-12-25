<?php

namespace App\Repositories\Province;

use App\Models\Province;
use App\Repositories\AbstractRepository;

class EloquentProvince extends AbstractRepository implements ProvinceRepository
{
    protected $model;

    /**
     * EloquentProvince constructor.
     * @param Province $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Province $model)
    {
        $this->model = $model;
    }
}

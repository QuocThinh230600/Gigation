<?php

namespace App\Repositories\Producer;

use App\Models\Producer;
use App\Repositories\AbstractRepository;

class EloquentProducer extends AbstractRepository implements ProducerRepository
{
    protected $model;

    /**
     * EloquentProducer constructor.
     * @param Producer $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Producer $model)
    {
        $this->model = $model;
    }
}

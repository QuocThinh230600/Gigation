<?php

namespace App\Repositories\Advantages;

use App\Models\Advantages;
use App\Repositories\AbstractRepository;

class EloquentAdvantages extends AbstractRepository implements AdvantagesRepository
{
    /**
     * @var Advantages
     */
    protected $model;

     /**
     * EloquentProduct constructor.
     * @param Advantages $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Advantages $model)
    {
        $this->model = $model;
    }


}

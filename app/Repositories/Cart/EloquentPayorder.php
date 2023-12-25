<?php

namespace App\Repositories\Cart;

use App\Models\Payoder;
use App\Repositories\AbstractRepository;

class EloquentPayorder extends AbstractRepository implements PayorderRepository
{
    protected $model;

    /**
     * EloquentPosition constructor.
     * @param Payoder $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Payoder $model)
    {
        $this->model = $model;
    }
}

<?php

namespace App\Repositories\Cart;

use App\Models\Paydetails;
use App\Repositories\AbstractRepository;

class EloquentPaydetails extends AbstractRepository implements PaydetailsRepository
{
    protected $model;

    /**
     * EloquentPosition constructor.
     * @param Paydetails $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Paydetails $model)
    {
        $this->model = $model;
    }
}

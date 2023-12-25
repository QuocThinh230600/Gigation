<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\AbstractRepository;

class EloquentCustomer extends AbstractRepository implements CustomerRepository
{
    /**
     * @var Customer
     */
    protected $model;

     /**
     * EloquentProduct constructor.
     * @param Customer $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function getAllCustomer():object
    {
        return $this->model->get();
    }
}

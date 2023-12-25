<?php

namespace App\Repositories\Customer;

use App\Repositories\AbstractInterface;

interface CustomerRepository extends AbstractInterface
{
    public function getAllCustomer():object;
}

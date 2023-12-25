<?php

namespace App\Repositories\coupon;

use App\Models\coupon;
use App\Repositories\AbstractRepository;

class Eloquentcoupon extends AbstractRepository implements couponRepository
{
    /**
     * @var coupon
     */
    protected $model;

    /**
     * Eloquentcoupon constructor.
     *
     * @param coupon $model
     * @author Quoc Tuan
     */
    public function __construct(coupon $model)
    {
        $this->model = $model;
    }
}

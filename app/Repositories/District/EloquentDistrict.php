<?php

namespace App\Repositories\District;

use App\Models\District;
use App\Repositories\AbstractRepository;

class EloquentDistrict extends AbstractRepository implements DistrictRepository
{
    protected $model;

    /**
     * EloquentDistrict constructor.
     * @param District $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(District $model)
    {
        $this->model = $model;
    }

    /**
     * Get all district
     * @return object
     */
    public function getAllDistrict (): object
    {
        return $this->model->with('province');
    }

    /**
     * Get district by province id
     * @param int $province
     * @return object
     */
    public function getDistrictByProvince(int $province): object
    {
        return $this->model->where('province_id', $province)->get();
    }

    /**
     * Get province by district id
     * @param int $district
     * @return object
     */
    public function getProvinceByDistrict (int $district): object
    {
        return $this->model->where('id', $district)->first();
    }
}

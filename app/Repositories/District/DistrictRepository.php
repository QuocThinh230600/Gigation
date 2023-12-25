<?php

namespace App\Repositories\District;

use App\Repositories\AbstractInterface;

interface DistrictRepository extends AbstractInterface
{
    /**
     * Get all district
     * @return object
     */
    public function getAllDistrict (): object;

    /**
     * Get district by province id
     * @param int $province
     * @return object
     */
    public function getDistrictByProvince (int $province): object;

    /**
     * Get province by district id
     * @param int $district
     * @return object
     */
    public function getProvinceByDistrict (int $district): object;
}

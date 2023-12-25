<?php

namespace App\Repositories\Ward;

use App\Repositories\AbstractInterface;

interface WardRepository extends AbstractInterface
{
    /**
     * Get all ward
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllWard (): object;

    /**
     * Get ward by district
     * @param int $district
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getWardByDistrict (int $district): object;
}

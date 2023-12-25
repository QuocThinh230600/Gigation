<?php

namespace App\Repositories\LogActivity;

use App\Repositories\AbstractInterface;

interface LogActivityRepository extends AbstractInterface
{
    /**
     * Delete Log Activity By Id
     * @param int $id
     * @return mixed
     */
    public function deleteById (int $id);
}

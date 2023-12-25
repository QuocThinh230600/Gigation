<?php

namespace App\Repositories\LogActivity;

use App\Models\LogActivity;
use App\Repositories\AbstractRepository;

class EloquentLogActivity extends AbstractRepository implements LogActivityRepository
{
    protected $model;

    /**
     * EloquentLogActivity constructor.
     * @param LogActivity $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LogActivity $model)
    {
        $this->model = $model;
    }

    /**
     * Delete Log Activity By Id
     * @param int $id
     * @return mixed
     */
    public function deleteById (int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}

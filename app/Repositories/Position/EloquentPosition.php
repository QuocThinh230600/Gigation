<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Repositories\AbstractRepository;
use DB;


class EloquentPosition extends AbstractRepository implements PositionRepository
{
    protected $model;

    /**
     * EloquentPosition constructor.
     * @param Position $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Position $model)
    {
        $this->model = $model;
    }

    /**
     * Get max position by parent
     * @param $parent
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getMaxPosition(int $parent): int
    {
        $position = $this->model->where("parent_id", $parent)->max('position');
        return $position + 1;
    }

    /**
     * Get all position
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllPositionRecursive(): object
    {
        return $this->model->where('id', '!=', 1)->orderBy('position', 'ASC')->get();
    }

    /**
     * Ajax update position table
     * @param int $id
     * @param int $position
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function updatePositionTable(int $id, int $position)
    {
        return $this->model->where('id', $id)->update(['position' => $position]);
    }

    /**
     * Count child to delete
     * @param string $uuid
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countChildToDelete($uuid): int
    {
        $position_id = $this->getIdByUuid($uuid);

        $totalPosition = $this->model->where('parent_id', $position_id)->count();

        if ($totalPosition <= 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get all position to update
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllPositionRecursiveToUpdate(int $id)
    {
        return $this->model->where(
            [
                ['parent_id', '!=', $id],
                ['id', '!=', $id],
                ['id', '!=', 1]
            ]
        )->orderBy('position', 'ASC')->get();
    }
}

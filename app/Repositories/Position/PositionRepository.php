<?php

namespace App\Repositories\Position;

use App\Repositories\AbstractInterface;

interface PositionRepository extends AbstractInterface
{
    /**
     * Get max position by parent
     * @param $parent
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getMaxPosition(int $parent): int;

    /**
     * Get all position
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllPositionRecursive(): object;

    /**
     * Ajax update position table
     * @param int $id
     * @param int $position
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function updatePositionTable(int $id, int $position);

    /**
     * Count child to delete
     * @param string $uuid
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countChildToDelete($uuid): int;

    /**
     * Get all position to update
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllPositionRecursiveToUpdate(int $id);
}

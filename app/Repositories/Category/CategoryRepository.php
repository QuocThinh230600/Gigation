<?php

namespace App\Repositories\Category;

use App\Repositories\AbstractInterface;

interface CategoryRepository extends AbstractInterface
{
    /**
     * Get max position by parent
     * @param $parent
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getMaxPosition(int $parent): int;

    /**
     * Get all category
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryRecursive(): object;

    /**
     * Get all category to update
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryRecursiveToUpdate(int $id);

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
     * Get all category by parent category product
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryRecursiveProduct($id);

    public function getAllCategoryByParent($id);
}

<?php

namespace App\Repositories\Attribute;

use App\Repositories\AbstractInterface;

interface AttributeRepository extends AbstractInterface
{
    /**
     * Get max position by parent
     * @param $parent
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getMaxPosition(int $parent): int;

    /**
     * Get all attribute
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllAttributeRecursive(): object;

    /**
     * Get all attribute to update
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllAttributeRecursiveToUpdate(int $id);

    /**
     * Count child to delete
     * @param string $uuid
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countChildToDelete($uuid): int;

    /**
     * Get all attribute
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllAttribute ();
}

<?php

namespace App\Repositories\Attribute;

use App\Models\Attribute;
use App\Repositories\AbstractRepository;

class EloquentAttribute extends AbstractRepository implements AttributeRepository
{
    protected $model;

    /**
     * EloquentProductAttribute constructor.
     * @param Attribute $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Attribute $model)
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
     * Get all attribute
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllAttributeRecursive(): object
    {
        return $this->model->where('id', '!=', 1)->orderBy('position', 'ASC')->get();
    }

    /**
     * Get all attribute to update
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllAttributeRecursiveToUpdate(int $id)
    {
        return $this->model->where(
            [
                ['parent_id', '!=', $id],
                ['id', '!=', $id],
                ['id', '!=', 1]
            ]
        )->orderBy('position', 'ASC')->get();
    }

    /**
     * Count child to delete
     * @param string $uuid
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countChildToDelete($uuid): int
    {
        $category_id = $this->getIdByUuid($uuid);

        $totalCategory = $this->model->where('parent_id', $category_id)->count();

        if ($totalCategory <= 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get all attribute
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllAttribute ()
    {
        return $this->model->with('all_attribute_child_name');
    }
}

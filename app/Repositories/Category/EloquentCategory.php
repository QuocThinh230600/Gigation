<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\AbstractRepository;

class EloquentCategory extends AbstractRepository implements CategoryRepository
{
    protected $model;

    /**
     * EloquentCategory constructor.
     * @param Category $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Category $model)
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
     * Get all category
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryRecursive(): object
    {
        return $this->model->where('id', '!=', 1)->orderBy('position', 'ASC')->get();
    }

    /**
     * Get all category to update
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryRecursiveToUpdate(int $id)
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
        $category_id = $this->getIdByUuid($uuid);

        $totalCategory = $this->model->where('parent_id', $category_id)->count();

        if ($totalCategory <= 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get all category by parent category product
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryRecursiveProduct($id)
    {
        $cate =  $this->model->where('parent_id', '=', $id)->orderBy('position', 'ASC')->get();
        return $cate;
    }


    /**
     * Get all category by parent category
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllCategoryByParent($id)
    {
        return $this->model->where('parent_id', '=', $id)->orderBy('position', 'ASC')->get();
    }
}

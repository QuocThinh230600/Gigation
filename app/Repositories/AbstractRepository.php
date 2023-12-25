<?php

namespace App\Repositories;

class AbstractRepository implements AbstractInterface
{
    /**
     * Count row
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countRow(): int
    {
        return $this->model->count();
    }

    /**
     * Count row with condition
     * @param string $col
     * @param string $val
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countRowCondition(string $col, string $val): int
    {
        return $this->model->where($col, $val)->count();
    }

    /**
     * Get id with uuid in row
     * @param string $uuid
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getIdByUuid(string $uuid): int
    {
        return $this->model->where('uuid', $uuid)->value('id');
    }

    /**
     * Get a row with uuid
     * @param string $uuid
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getByUuid(string $uuid): object
    {
        return $this->model->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Get a row with slug
     * @param string $slug
     * @return object
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getBySlug(string $slug): object
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    /**
     * Get a row with id
     * @param int $id
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getById(int $id): object
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    /**
     * Get all rows data with pagination 10 rows
     * @param array $cols
     * @param int $limit
     * @param string $order_col
     * @param string $order_val
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getWithLimit($cols = array('*'), int $limit = 10, string $order_col = 'created_at', string $order_val = 'desc'): object
    {
        $select = '';

        foreach ($cols as $col) {
            $select .= $col . ",";
        }

        return $this->model->select(rtrim($select, ','))->orderBy($order_col, $order_val)->paginate($limit);
    }

    /**
     * Get all rows data no pagination
     * @param array $cols
     * @param string $order_col
     * @param string $order_val
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllQuery($cols = array('*'), string $order_col = 'created_at', string $order_val = 'desc'): object
    {
        return $this->model->select($cols)->orderBy($order_col, $order_val);
    }

    /**
     * Get all rows data no pagination
     * @param array $cols
     * @param string $order_col
     * @param string $order_val
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAll($cols = array('*'), string $order_col = 'created_at', string $order_val = 'desc'): object
    {
        return $this->model->select($cols)->orderBy($order_col, $order_val)->get();
    }

    /**
     * Update data row
     * @param array $attributes
     * @param string $uuid
     * @param bool $useUuid
     * @param bool $getDataBack
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(array $attributes, string $uuid, bool $useUuid = true, bool $getDataBack = true): object
    {
        if ($useUuid) {
            $update = $this->model->where('uuid', $uuid)->update($attributes);

            if ($getDataBack) {
                $update = $this->getByUuid($uuid);
            }
        } else {
            $update = $this->model->where('id', $uuid)->update($attributes);

            if ($getDataBack) {
                $update = $this->getById($uuid);
            }
        }
        return $update;
    }

    /**
     * Delete one row
     * @param string $uuid
     * @param bool $useUuid
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function remove(string $uuid, bool $useUuid = true)
    {
        if ($useUuid) {
            return $this->model->where('uuid', $uuid)->delete();
        } else {
            return $this->model->where('id', $uuid)->delete();
        }
    }

    /**
     * Create data
     * @param array $attributes
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create(array $attributes): object
    {
        return $this->model->create($attributes);
    }

    /**
     * Query data
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function query(): object
    {
        return $this->model->query();
    }
}

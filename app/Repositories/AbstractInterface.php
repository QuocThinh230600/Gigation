<?php

namespace App\Repositories;

interface AbstractInterface
{
    /**
     * Count row
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countRow(): int;

    /**
     * Count row with condition
     * @param string $col
     * @param string $val
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function countRowCondition(string $col, string $val): int;

    /**
     * Get id with uuid in row
     * @param string $uuid
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getIdByUuid(string $uuid): int;

    /**
     * Get a row with uuid
     * @param string $uuid
     * @return object
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getByUuid(string $uuid): object;

    /**
     * Get a row with slug
     * @param string $slug
     * @return object
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getBySlug(string $slug): object;

    /**
     * Get a row with id
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getById(int $id): object;

    /**
     * Get all rows data with pagination 10 rows
     * @param array $cols
     * @param int $limit
     * @param string $order_col
     * @param string $order_val
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getWithLimit($cols = array('*'), int $limit = 10, string $order_col = 'created_at', string $order_val = 'desc'): object;

    /**
     * Get all rows data no pagination
     * @param array $cols
     * @param string $order_col
     * @param string $order_val
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllQuery($cols = array('*'), string $order_col = 'created_at', string $order_val = 'desc'): object;

    /**
     * Get all rows data no pagination
     * @param array $cols
     * @param string $order_col
     * @param string $order_val
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAll($cols = array('*'), string $order_col = 'created_at', string $order_val = 'desc'): object;

    /**
     * Update data row
     * @param array $attributes
     * @param string $uuid
     * @param bool $useUuid
     * @param bool $getDataBack
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(array $attributes, string $uuid, bool $useUuid = true,bool $getDataBack = true): object;

    /**
     * Delete one row
     * @param string $uuid
     * @param bool $useUuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function remove(string $uuid, bool $useUuid = true);

    /**
     * Create data
     * @param array $attributes
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create(array $attributes): object;

    /**
     * Query data
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function query(): object;
}

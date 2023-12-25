<?php

namespace App\Repositories\LoginHistory;

use App\Repositories\AbstractInterface;

interface LoginHistoryRepository extends AbstractInterface
{
    /**
     * Update record by login session id
     * @param string $session_id
     * @param array $data
     * @param bool $getDataBack
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function updateBySessionId(string $session_id, array $data, bool $getDataBack = true);

    /**
     * Get history in a month
     * @param string $uuid
     * @return object
     */
    public function getHistoryByUser(string $uuid): object;

    /**
     * Detele history in a month
     * @param string $uuid
     * @return mixed
     */
    public function deleteHistoryByUser(string $uuid);
}

<?php

namespace App\Repositories\LoginHistory;

use App\Models\LoginHistory;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Carbon;

class EloquentLoginHistory extends AbstractRepository implements LoginHistoryRepository
{
    protected $model;

    /**
     * EloquentLoginHistory constructor.
     * @param LoginHistory $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LoginHistory $model)
    {
        $this->model = $model;
    }

    /**
     * Update record by login session id
     * @param string $session_id
     * @param array $data
     * @param bool $getDataBack
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function updateBySessionId(string $session_id, array $data, bool $getDataBack = true)
    {
        $update = $this->model->where('session_id', $session_id)->update($data);

        if ($getDataBack) {
            $update = $this->model->where('session_id', $session_id)->first();
        }

        return $update;
    }

    /**
     * Get history in a month
     * @param string $uuid
     * @return object
     */
    public function getHistoryByUser(string $uuid): object
    {
        return $this->model->where('user_uuid', $uuid)
            ->where('created_at', '>=', Carbon::now()->subMonth()->toDateTimeString())->get();
    }

    /**
     * Detele history in a month
     * @param string $uuid
     * @return mixed
     */
    public function deleteHistoryByUser(string $uuid)
    {
        return $this->model->where('user_uuid', $uuid)
            ->where('created_at', '<=', Carbon::now()->subMonth()->toDateTimeString())->delete();
    }
}

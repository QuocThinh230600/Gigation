<?php

namespace App\Repositories;

class AbstractTranslationRepository extends AbstractRepository implements AbstractTranslationInterface
{
    /**
     * Get total data translated
     * @param int $id
     * @param string $col
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getTotalTranslated(string $col, int $id): int
    {
        return $this->model->where($col, $id)->count();
    }

    /**
     * Get translated
     * @param int $id
     * @param string $col
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getTranslated(string $col, int $id)
    {
        return $this->model->where(
            [
                [$col, $id],
                ['locale', config('app.locale')]
            ]
        )->first();
    }

    /**
     * Get total locale translated
     * @param int $id
     * @param string $col
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getLocaleTranslated(string $col, int $id)
    {
        return $this->model->where($col, $id)->select('locale')->pluck('locale');
    }

    /**
     * Get uuid by page id and locale
     * @param array $trans
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getUuidByIdAndLocale(array $trans)
    {
        return $this->model->where($trans)->value('uuid');
    }
}

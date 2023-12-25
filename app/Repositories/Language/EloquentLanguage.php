<?php

namespace App\Repositories\Language;

use App\Models\Language;
use App\Repositories\AbstractRepository;

class EloquentLanguage extends AbstractRepository implements LanguageRepository
{
    protected $model;

    /**
     * EloquentLanguage constructor.
     * @param Language $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    /**
     * Check language default on the site
     * @return bool
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function checkLanguageDefault(): bool
    {
        $count = $this->model->where('default', 'on')->count();

        if ($count > 0) {
            return false;
        }

        return true;
    }

    /**
     * Check language default on the site when edit or delete data
     * @param $uuid
     * @return bool
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function checkLanguageDefaultByUuid($uuid): bool
    {
        $language = $this->model->where('default', 'on')->first();

        if (!is_null($language)) {
            if ($language->uuid == $uuid) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Check language current
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function checkLanguageCurrent(): object
    {
        $locale = app()->getLocale();

        return $this->model->where('locale', $locale)->first() ?? $this->model->first();
    }

    /**
     * Get all language with status is on
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllWithStatusOn(): object
    {
        return $this->model->where('status', 'on')->get();
    }

    /**
     * Get all locale language
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllLocale(): object
    {
        return $this->model->select('locale')->pluck('locale');
    }

    /**
     * Get language by locale
     * @param array $locale
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getLanguageByLocale($locale): object
    {
        return $this->model->whereIn('locale', $locale)->get();
    }
}

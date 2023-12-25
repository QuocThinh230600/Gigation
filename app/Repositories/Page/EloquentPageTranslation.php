<?php

namespace App\Repositories\Page;

use App\Models\PageTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentPageTranslation extends AbstractTranslationRepository implements PageTranslationRepository
{
    protected $model;

    /**
     * EloquentPageTranslation constructor.
     * @param PageTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(PageTranslation $model)
    {
        $this->model = $model;
    }
}

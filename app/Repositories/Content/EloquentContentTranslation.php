<?php

namespace App\Repositories\Content;

use App\Models\ContentTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentContentTranslation extends AbstractTranslationRepository implements ContentTranslationRepository
{
    protected $model;

    /**
     * EloquentContentTranslation constructor.
     * @param ContentTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ContentTranslation $model)
    {
        $this->model = $model;
    }
}

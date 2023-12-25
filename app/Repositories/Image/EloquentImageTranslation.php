<?php

namespace App\Repositories\Image;

use App\Models\ImageTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentImageTranslation extends AbstractTranslationRepository implements ImageTranslationRepository
{
    protected $model;

    /**
     * EloquentImageTranslation constructor.
     * @param ImageTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ImageTranslation $model)
    {
        $this->model = $model;
    }
}

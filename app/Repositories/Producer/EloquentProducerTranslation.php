<?php

namespace App\Repositories\Producer;

use App\Models\ProducerTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentProducerTranslation extends AbstractTranslationRepository implements ProducerTranslationRepository
{
    protected $model;

    /**
     * EloquentProducerTranslation constructor.
     * @param ProducerTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ProducerTranslation $model)
    {
        $this->model = $model;
    }
}

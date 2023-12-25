<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\AbstractRepository;

class EloquentUser extends AbstractRepository implements UserRepository
{
    protected $model;

    /**
     * EloquentUser constructor.
     * @param User $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}

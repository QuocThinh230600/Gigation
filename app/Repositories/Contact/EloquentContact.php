<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\AbstractRepository;

class EloquentContact extends AbstractRepository implements ContactRepository
{
    protected $model;

    /**
     * EloquentContact constructor.
     * @param Contact $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Get all contact with reply
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllContactWithReply(): object
    {
        return $this->model->with('reply_contact');
    }
}

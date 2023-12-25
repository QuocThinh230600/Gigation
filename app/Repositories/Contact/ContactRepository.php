<?php

namespace App\Repositories\Contact;

use App\Repositories\AbstractInterface;

interface ContactRepository extends AbstractInterface
{
    /**
     * Get all contact with reply
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllContactWithReply(): object;
}

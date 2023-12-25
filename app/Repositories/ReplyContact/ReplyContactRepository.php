<?php

namespace App\Repositories\ReplyContact;

use App\Repositories\AbstractInterface;

interface ReplyContactRepository extends AbstractInterface
{
    /**
     * Get all reply of contact
     * @param int $id
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllReplyOfContact(int $id): object;
}

<?php

namespace App\Repositories\Attribute;

use App\Repositories\AbstractTranslationInterface;

interface AttributeTranslationRepository extends AbstractTranslationInterface
{
    /**
     * Get data by product_id
     * @return mixed
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function attribute_product($product_id);
}

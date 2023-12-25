<?php

namespace App\Repositories\Attribute;

use App\Models\AttributeTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentAttributeTranslation extends AbstractTranslationRepository implements AttributeTranslationRepository
{
    protected $model;

    /**
     * EloquentAttributeTranslation constructor.
     * @param AttributeTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(AttributeTranslation $model)
    {
        $this->model = $model;
    }

        /**
     * Get data by product_id
     * @return mixed
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function attribute_product($product_id)
    {
        return $this->model::LeftJoin('product_attributes', 'attributes_translations.attribute_id', '=', 'product_attributes.attribute')
        ->where('product_attributes.deleted_at', '=', null)
        ->where('product_attributes.product_id', '=', $product_id)
        ->get();
    }
}

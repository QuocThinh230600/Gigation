<?php

namespace App\Repositories\Product;

use App\Models\ProductTranslation;
use App\Repositories\AbstractTranslationRepository;

class EloquentProductTranslation extends AbstractTranslationRepository implements ProductTranslationRepository
{
    protected $model;

    /**
     * EloquentProductTranslation constructor.
     * @param ProductTranslation $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ProductTranslation $model)
    {
        $this->model = $model;
    }

    public function getProductTranslation($slug)
    {
        return $this->model->where('slug','=', $slug)->first();
    }

    public function getAllProductRecursive(){
        return $this->model->leftJoin('products','product_id','=','products.id')->where('products.deleted_at','=',null)->get();
    }
}

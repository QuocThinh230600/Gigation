<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\AbstractRepository;

class EloquentProduct extends AbstractRepository implements ProductRepository
{
    /**
     * @var Product
     */
    protected $model;

     /**
     * EloquentProduct constructor.
     * @param Product $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Get new position in product
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getNewPosition(): int
    {
        $position = $this->model->max('position');

        return ($position == null) ? 1 : $position + 1;
    }

    /**
     * Get data product with uuid
     * @param string $uuid
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getProductUuid(string $uuid): array
    {
        $product = $this->model->where('uuid', $uuid)->first();
        $category = $product->category_product()->pluck('category_id')->toArray();
        $attribute = $product->product_attribute()->get();
        $images = $product->product_images()->select('image', 'alt', 'position')->get();
        // $attribute = $this->model->with('product_attribute')->where('uuid', $uuid)->get();

        return [
            'product' => $product,
            'category' => $category,
            'attribute' => $attribute,
            'images' => $images,
        ];
    }



}

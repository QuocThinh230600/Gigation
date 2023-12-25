<?php

namespace App\Repositories\Product;

use App\Repositories\AbstractInterface;

interface ProductRepository extends AbstractInterface
{
/**
     * Get new position in product
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getNewPosition(): int;

    /**
     * Get data product with uuid
     * @param string $uuid
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getProductUuid(string $uuid): array;

    
}

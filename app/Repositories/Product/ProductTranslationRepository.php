<?php

namespace App\Repositories\Product;

use App\Repositories\AbstractTranslationInterface;

interface ProductTranslationRepository extends AbstractTranslationInterface
{
    public function getProductTranslation($slug);

    public function getAllProductRecursive();
}

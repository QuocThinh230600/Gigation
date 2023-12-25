<?php

namespace App\Repositories\Category;

use App\Repositories\AbstractTranslationInterface;

interface CategoryTranslationRepository extends AbstractTranslationInterface
{
    /**
     * get id category with slug
     * @return mixed
     * @author Trần Luân <luantran4555@gmail.com>
     */
    public function getIDCategory($slug);

    /**
     * get id category with slug
     * @return mixed
     * @author Trần Luân <luantran4555@gmail.com>
     */
    public function getNameCategory($slug);

    public function getCategoryTranslation($slug);
}

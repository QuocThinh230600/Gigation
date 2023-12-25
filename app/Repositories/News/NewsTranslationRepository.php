<?php

namespace App\Repositories\News;

use App\Repositories\AbstractTranslationInterface;

interface NewsTranslationRepository extends AbstractTranslationInterface
{
    /**
     * get id category with slug
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getIDNews($slug);

    /**
     * get author with slug
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getAuthor($slug);
    
    /**
     * get news with author
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsWithAuthor($author);
}

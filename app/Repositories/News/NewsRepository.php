<?php

namespace App\Repositories\News;

use App\Repositories\AbstractInterface;

interface NewsRepository extends AbstractInterface
{
    /**
     * Get new position in news
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getNewPosition(): int;

    /**
     * Get all data news with pivot category
     * @return object
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getAllNews(): object;

    /**
     * Get data news with uuid
     * @param string $uuid
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getNewsUuid(string $uuid): array;

    /**
     * Get data news with cate_id and take
     * @param string $category_id, $take
     * @return array
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsWithCategory($category_id , $take);

    /**
     * Get data news with featured and take
     * @param string $featured, $take
     * @return array
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsWithFeatured($featured, $take);

    /**
     * Get news by id
     * @param string $category_id
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsByCategoryID($category_id);

    /**
     * Get news detail
     * @param string $news_id
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getFirstNew($news_id);

    /**
     * Get news by id_news
     * @param string $id_news
     * @return 
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function getNewsByNewsID($news_id);

    /**
     * Get news with key
     * @param string $keys
     * @return array
     * @author Trần Luân <luantran04555@gmail.com>
     */
    public function SearchNews($key);
}

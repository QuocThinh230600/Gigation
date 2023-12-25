<?php

namespace App\Repositories\Content;

use App\Repositories\AbstractInterface;

interface ContentRepository extends AbstractInterface
{
    /**
     * Get content with page id
     * @param int $page_id
     * @return mixed
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getContentWithPage(int $page_id);

    /**
     * Get content and page
     * @param int $page_id
     * @return mixed
     * @author Quốc  <contact.quoctuan@gmail.com>
     */
    public function getContentAndPage(int $page_id);
}

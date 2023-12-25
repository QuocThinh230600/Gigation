<?php

namespace App\Repositories;

interface AbstractTranslationInterface extends AbstractInterface
{
    /**
     * Get total data translated
     * @param int $id
     * @param string $col
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getTotalTranslated(string $col, int $id): int;

    /**
     * Get translated
     * @param int $id
     * @param string $col
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getTranslated(string $col, int $id);

    /**
     * Get total locale translated
     * @param int $id
     * @param string $col
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getLocaleTranslated(string $col, int $id);

    /**
     * Get uuid by page id and locale
     * @param array $trans
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getUuidByIdAndLocale(array $trans);
}

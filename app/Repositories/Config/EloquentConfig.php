<?php

namespace App\Repositories\Config;

use App\Models\Config;
use App\Repositories\AbstractRepository;

class EloquentConfig extends AbstractRepository implements ConfigRepository
{
    protected $model;

    /**
     * EloquentConfig constructor.
     * @param Config $model
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(Config $model)
    {
        $this->model = $model;
    }

    /**
     * Update value config from attrubute
     * @param string $attribute
     * @param string $value
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update_value(string $attribute, string $value = null)
    {
        return $this->model->where('attribute', $attribute)->update([
            'value'      => $value,
            'updated_at' => new \DateTime()
        ]);
    }

    /**
     * Get all config
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function get_all_config()
    {
        return $this->model->pluck('value', 'attribute')->toArray();
    }
}

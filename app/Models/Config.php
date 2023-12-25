<?php

namespace App\Models;

use Rennokki\QueryCache\Traits\QueryCacheable;

class Config extends BaseModel
{
    use QueryCacheable;
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)
    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'configs';


    /**
     * equivalent of ->cacheTags(['configs'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['configs'];
    /**
     * equivalent of ->cachePrefix('configs_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'configs_';
    /**
     * Invalidate the cache automatically
     * upon update in the database.
     *
     * @var bool
     */
    protected static $flushCacheOnUpdate = true;


    /**
     * The attributes that aren't mass assignable.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $dates = ['created_at', 'updated_at'];
}

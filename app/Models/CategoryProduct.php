<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CategoryProduct extends BaseModel
{
    use SoftDeletes,QueryCacheable;

    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'category_products';

    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)
    /**
     * equivalent of ->cacheTags(['category_products'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['category_products'];
    /**
     * equivalent of ->cachePrefix('category_products_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'category_products_';
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
     * Indicates if the model should be timestamped.
     * @var bool
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $dates = ['deleted_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ProductAttribute extends BaseModel
{
    use SoftDeletes, QueryCacheable;
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)

    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'product_attributes';

    /**
     * equivalent of ->cacheTags(['product_attributes'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['product_attributes'];
    /**
     * equivalent of ->cachePrefix('product_attributes_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'product_attributes_';
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

    public $timestamps = false;

}

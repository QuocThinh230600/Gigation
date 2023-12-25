<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class NewsImage extends BaseModel
{
    use SoftDeletes, QueryCacheable;
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)
    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'news_image';

    /**
     * equivalent of ->cacheTags(['news_image'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['news_image'];
    /**
     * equivalent of ->cachePrefix('news_image_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'news_image_';
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
     * Get the news that owns the image.
     */
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}

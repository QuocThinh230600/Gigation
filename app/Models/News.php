<?php

namespace App\Models;

use Illuminate\Support\Str;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class News extends BaseModel implements TranslatableContract
{
    use SoftDeletes, Translatable, SoftCascadeTrait, QueryCacheable;
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)
    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'news';

    /**
     * equivalent of ->cacheTags(['news'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['news'];
    /**
     * equivalent of ->cachePrefix('news_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'news_';
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

    /**
     * The attributes soft delete with function name.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $softCascade = ['news_translation', 'news_images', 'category_news'];

    /**
     * The attributes translate language.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public $translatedAttributes = ['title', 'author', 'copyright', 'intro', 'content', 'foot', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description', 'meta_robots', 'meta_google_bot', 'locale', 'news_id'];

    /**
     * The auto generate uuid
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });
    }

    /**
     * Relationship with translation
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function news_translation()
    {
        return $this->hasMany(NewsTranslation::class);
    }

    /**
     * The category that belong to the news.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_news');
    }

    /**
     * The category that belong to the news.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function category_news()
    {
        return $this->hasMany(CategoryNews::class);
    }

    /**
     * Get the images for the news.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function news_images()
    {
        return $this->hasMany(NewsImage::class);
    }
}

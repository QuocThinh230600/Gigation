<?php

namespace App\Models;

use App\Models\Advantages;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends BaseModel implements TranslatableContract
{
    use SoftDeletes, Translatable, SoftCascadeTrait, QueryCacheable;
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)

    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'products';

    /**
     * equivalent of ->cacheTags(['products'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['products'];
    /**
     * equivalent of ->cachePrefix('products_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'products_';
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
    protected $softCascade = ['product_translation', 'product_images', 'category_product'];

    /**
     * The attributes translate language.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public $translatedAttributes = ['name','attribute_value', 'quantity','title', 'promotion_id', 'price', 'discount', 'description', 'content', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description', 'locale', 'product_id'];

    /**
     * The auto generate uuid
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * Relationship with translation
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function product_translation()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    /**
     * The category that belong to the news.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    /**
     * The category that belong to the product.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function category_product()
    {
        return $this->hasMany(CategoryProduct::class);
    }

    /**
     * Get the images for the product.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the attribute for the product.
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function product_attribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }



}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Producer extends BaseModel implements TranslatableContract
{
    use SoftDeletes, Translatable, SoftCascadeTrait, QueryCacheable;
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)

    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'producers';

    /**
     * equivalent of ->cacheTags(['producers'])
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cacheTags = ['producers'];
    /**
     * equivalent of ->cachePrefix('producers_');
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
    */
    public $cachePrefix = 'producers_';
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
    protected $softCascade = ['producer_translation'];

    /**
     * The attributes translate language.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public $translatedAttributes = ['name', 'address', 'phone', 'email', 'description', 'locale', 'producer_id'];

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
    public function producer_translation()
    {
        return $this->hasMany(ProducerTranslation::class);
    }
}

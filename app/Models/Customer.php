<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Rennokki\QueryCache\Traits\QueryCacheable;

class customer extends BaseModel
{
    use SoftDeletes, QueryCacheable;

    /**
     * The table associated with the model.
     *
     * @var string
     * @author Quoc Tuan
     */
    protected $table = 'customer';
    public $cacheFor = 3600; // equivalent of ->cacheFor(3600)
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     * @author Quoc Tuan
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     * @author Quoc Tuan
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The auto generate uuid
     *
     * @author Quoc Tuan
     */
    public static function boot ()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}

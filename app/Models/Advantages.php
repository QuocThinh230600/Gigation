<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Category;

class advantages extends BaseModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     * @author Quoc Tuan
     */
    protected $table = 'advantages_table';

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


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

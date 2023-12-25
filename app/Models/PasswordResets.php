<?php

namespace App\Models;

class PasswordResets extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     * @var array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    protected $guarded = [];
}

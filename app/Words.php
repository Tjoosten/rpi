<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Words';
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table columns for mass assignment.
     *
     * @var array
     */
    protected $fillable = ['dialect', 'description', 'word_an', 'user_id', 'region_id'];
}

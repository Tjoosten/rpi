<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Statistics';
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
    
    protected $fillable = ['user_id'];
}

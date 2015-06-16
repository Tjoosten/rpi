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
    protected $fillable = ['user_id'];
}

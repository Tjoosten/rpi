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

    protected $fillable = ['dialect', 'description', 'word_an'];
}

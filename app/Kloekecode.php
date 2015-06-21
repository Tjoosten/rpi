<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Kloekecode extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Kloekecode';
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}

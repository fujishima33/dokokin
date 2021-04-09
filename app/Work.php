<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = array('id');
    
    public function placement()
    {
        return $this->hasMany('App\Placement');
    }
}

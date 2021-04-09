<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'work_title' => 'required',
        'body' => 'required',
    );
    
    public function placement()
    {
        return $this->hasMany('App\Placement');
    }
}

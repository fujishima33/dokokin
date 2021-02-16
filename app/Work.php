<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'work_title' => 'required',
        'body' => 'required',
    );
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timestamp extends Model
{
    protected $fillable = ['user_id', 'punchIn', 'punchOut', 'work_id', 'detail'];

    protected $dates = ['punchIn', 'punchOut'];
    /**
     * ユーザー関連付け
     * 1対多
     */
    public function user()
    {
        $this->belongsTo('App\User');
    }
}

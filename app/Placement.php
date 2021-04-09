<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    protected $fillable = ['author_id', 'user_id', 'work_id', 'regist_date'];
    
    public static $rules = array(
        'work_id' => 'required',
    );
    
    //ユーザーとの関連付け：1対多
    public function user()
    {
        $this->belongsTo('App\User');
    }
    //案件との関連付け：1対多
    public function work()
    {
        $this->belongsTo('App\Work');
    }
}

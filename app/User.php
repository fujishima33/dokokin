<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'author_id', 'image_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //社員登録の作成者（author_id）との関連付け
    public function general_users()
    {
        return $this->hasMany(User::class, 'author_id');
    }
    
    //打刻情報との関連付け：1対多
    public function timestamp()
    {
        return $this->hasMany('App\Timestamp');
    }
    
    //人員配置との関連付け：1対多
    public function placement()
    {
        return $this->hasMany('App\Placement');
    }
}

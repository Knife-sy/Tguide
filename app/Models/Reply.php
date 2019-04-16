<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Notifiable;

    protected $fillable = [
        'guide_id', 'content', 'user_id', 'reply_pre',
    ];

    /**
     * 用户
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * 攻略
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function guide()
    {
        return $this->hasOne(Guide::class, 'id', 'guide_id');
    }
}

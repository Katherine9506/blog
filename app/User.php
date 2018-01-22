<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $guarded = [];

    //获取当前用户的文章列表
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    //我的粉丝
    public function fans()
    {
        //第一个参数：要关联的对象
        //第二个参数： 关联对象的外键
        //第三个参数：当前模型的主键
        return $this->hasMany(Fan::class, "star_id", "id");
    }

    //我关注的Fan模型
    public function stars()
    {
        return $this->hasMany(Fan::class, "fan_id", "id");
    }

    //我关注某人
    public function doFan($uid)
    {
        $this->stars()->create([
            'star_id' => $uid,
        ]);
    }

    //取消关注
    public function doUnFan($uid)
    {
        $this->stars()->where([
            'star_id' => $uid
        ])->delete();
    }

    //当前用户是否被uid关注
    public function hasFan($uid)
    {
        $this->fans()->where('fan_id', $uid)->count();
    }

    //当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }
}

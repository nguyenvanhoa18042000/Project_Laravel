<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    protected $table = 'user_info';

   // public function userInfo(){
    //	return $this->hasOne(Userinfo::class);

    	//return $this->hasOne(UserInfo::class, 'foreign_key', 'local_key');
    	//nếu ko đúng user_id và id thì n sẽ phải thêm khóa ngoại và khóa chính của băng user
    //}

    public function use(){//tên func phải là user để La hiểu user_id còn ko thì phải return $this->belongsTo(User::class,'user_id');
        return $this->belongsTo(User::class,'user_id');
        //return $this->belongsTo('App\User'); 
        // 
    }
}

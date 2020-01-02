<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
    public function user_info(){
    	return $this->hasOne(Userinfo::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }
}

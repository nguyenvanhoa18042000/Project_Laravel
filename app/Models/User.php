<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
	use SoftDeletes;
	protected $dates = ['deleted_at','created_at','updated_at'];
	protected $fillable = [
        'name', 'email', 'password','phone','address',
    ];
	
    public function user_info(){
    	return $this->hasOne(Userinfo::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }
}

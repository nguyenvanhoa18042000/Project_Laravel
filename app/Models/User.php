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
        'name', 'email','avatar', 'password','phone','address',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}

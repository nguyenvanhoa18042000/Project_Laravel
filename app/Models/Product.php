<?php

namespace App\Models;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    protected $set_status = [
    	1 => [
    		'name' => '<i class="fa fa-globe"></i>'
    	],
    	0 => [
    		'name' => '<i class="fa fa-lock"></i>'
    	]
    ];

    public function getStatus(){
    	return array_get($this->set_status,$this->status,'[N\A]');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}

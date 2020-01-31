<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Trademark extends Model
{
    protected $table = 'trademarks';
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at','created_at','updated_at'];

    public function categories(){
    	return $this->belongsToMany(Category::class)->withTimestamps();
	}

	public function products(){
    	return $this->belongsTo(Product::class);
	}

}

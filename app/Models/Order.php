<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	const STATUS_DONE = 4; 
	const STATUS_NO_PROCESS = 1;
	const STATUS_DELIVERY = 3;
	const STATUS_PROCESS = 2;
	const STATUS_CANCELLED = 0;

	public function user(){
    	return $this->belongsTo(User::class);
	}
	
	public function products(){
    	return $this->belongsToMany(Product::class)->withPivot('quantity','origin_price','sale_price','discount_percent')->withTimestamps();
	}
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Rating extends Model
{
	use Notifiable;
    use SoftDeletes;
    protected $table = 'ratings';
    protected $dates = ['deleted_at','created_at','updated_at'];
	// protected $with = ['user'];
	 //luôn muốn user theo comment nào đó

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    protected $table = 'categories';
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['created_at','updated_at'];
    // protected $guarded = ['*'];

    const HOT = 1;
    
    public function products(){
    	return $this->hasMany(Product::class,'category_id','id')->withTrashed();
    }

    public function trademarks(){
        return $this->belongsToMany(Trademark::class,'category_trademark', 'category_id', 'trademark_id')->withTrashed()->withTimestamps();
    }
}
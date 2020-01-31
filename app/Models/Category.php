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
    
    public function products(){
    	return $this->hasMany(Product::class)->withTrashed();
    }

    public function trademarks(){
        return $this->belongsToMany(Trademark::class)->withTrashed()->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NewsCategory extends Model
{
    protected $table = 'news_categories';

    public function posts(){
    	return $this->hasMany(Post::class,'news_category_id','id')->withTrashed();
    }
}

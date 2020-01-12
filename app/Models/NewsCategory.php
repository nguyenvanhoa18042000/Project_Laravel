<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'news_categories';

    public function posts(){
    	return $this->hasMany(Post::class,'news_category_id','id');
    }
}

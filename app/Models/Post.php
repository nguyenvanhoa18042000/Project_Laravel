<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function news_category(){
        return $this->belongsTo(NewsCategory::class,'news_category_id','id');
    }
}

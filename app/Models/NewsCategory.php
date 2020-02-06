<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NewsCategory extends Model
{
    protected $table = 'news_categories';
    use Notifiable;
    use SoftDeletes;

    public function user(){
    	return belongsTo(User::class);
    }

    public function posts(){
    	return $this->hasMany(Post::class,'news_category_id','id')->withTrashed();
    }
}

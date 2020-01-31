<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    protected $table = 'posts';
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at','created_at','updated_at'];

    public function news_category(){
        return $this->belongsTo(NewsCategory::class,'news_category_id','id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }
}

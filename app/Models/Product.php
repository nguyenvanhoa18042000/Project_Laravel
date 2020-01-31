<?php

namespace App\Models;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    protected $table = 'products';
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at','created_at','updated_at'];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    protected $set_status = [
    	1 => [
    		'name' => '<i class="fa fa-globe"></i>'
    	],
    	0 => [
    		'name' => '<i class="fa fa-lock"></i>'
    	]
    ];

    public function getStatus(){
    	return array_get($this->set_status,$this->status,'[N\A]');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->withTrashed();
    }
    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class)->withTrashed();
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
    public function trademarks(){
        return $this->hasOne(Trademark::class)->withTrashed();
    }

    public static function boot() {
        parent::boot();

        static::deleted(function($product) { 
            $product->ratings()->delete();
            $product->product_images()->delete();
            // $product->users()->detach();
        });
    }
}

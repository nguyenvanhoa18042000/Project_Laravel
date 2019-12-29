<?php

namespace App\Models;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// protected static function boot()
 //    {
 //        parent::boot();

 //        static::addGlobalScope(new StatusScope);
 //    }

    protected $table = 'products';

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
}

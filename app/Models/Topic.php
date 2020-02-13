<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    public function contacts(){
    	return $this->hasMany(Contact::class,'topic_id','id');
	}
}

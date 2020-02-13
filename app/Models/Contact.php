<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';

    public function topic(){
    	return $this->belongsTo(Topic::class);
	}
}

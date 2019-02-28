<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fine extends Model
{


	protected $fillable=['staff_id','reason'];


	public function staff(){
		return $this->belongsTo('App\Staff');
	}

	
	
}

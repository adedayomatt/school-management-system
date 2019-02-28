<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parentt extends Model
{

    protected $fillable=[
		'user_id','enrollment_id','fullname','phone','home_address','relation', 'occupation','business_address'
	];

	public function fullname(){
		return $this->fullname;
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function enrollment(){
		return $this->belongsTo('App\Enrollment');
	}


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parentt extends Model
{
	use SoftDeletes;

	protected $dates=['deleted_at'];

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

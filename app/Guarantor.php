<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
	protected $fillable=[
		'staff_id','surname','other_names','gender','marital_status',
        'phone','email','business_address','home_address','nationality',
        'employer', 'years_with_employer'
        ];

    public function fullname(){
        return $this->surname.' '.$this->other_names;
    }

    public function staff(){
        return $this->belongsTo('App\Staff');
    }
        

}

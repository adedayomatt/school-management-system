<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guarantor extends Model
{
    use softDeletes;

    protected $dates=['deleted_at'];
    
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

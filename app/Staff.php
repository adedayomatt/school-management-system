<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Staff extends Model
{
  use SoftDeletes;
  use SearchableTrait;


	protected $dates=['deleted_at'];

	protected $fillable=[
		'user_id','surname','other_names','dob','gender','marital_status',
		'phone','email','first_appointment','nationality','state',
		'lga','town','village','permanent_address','residential_address','emergency_contact',
		'role_id','classroom_id'
		];

		protected $searchable = [
			'columns' => [
				'staff.surname' => 10,
				'staff.other_names' => 10 
			],
			'joins' => [
				'roles' => ['roles.id','staff.role_id'],
				'classrooms' => ['classrooms.id','staff.classroom_id']
				]
			];
	
	public function fullname(){
			return $this->surname.' '.$this->other_names;
		}
	public function guarantor(){
		return $this->hasOne('App\Guarantor');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}

	public function classroom(){
		return $this->belongsTo('App\Classroom');
	}

	public function role(){
		return $this->belongsTo('App\Role');
	}

	public function fines(){
		return $this->hasMany('App\Fine');
	}

	public function StaffAttendance(){
		return $this->hasMany('App\StaffAttendance');
	}

    public function dob(){
        if($this->dob !== null){
            $date = new DateTime($this->dob);
            return $date->format('d M, Y');
            }
            else{
                return 'n/a';
            }
    }
	public function isAuth(){
		return $this->user === null ? false : true;
	}
	public function isAdmin(){
		return $this->role->id == 1 ? true : false;
	}
	public function isTeacher(){
		return $this->role->id == 2 ? true : false;
	}
	public function isAsstTeacher(){
		return $this->role->id == 3 ? true : false;
	}

	public function hasClass(){
		return $this->classroom == null ? false : true;
	}
	
	public function class(){
		return $this->classroom_id !== null && $this->classroom_id > 0 ? '<a href="'.route('class.show',[$this->classroom->id]).'">'.$this->classroom->name.'</a>': '<small class="text-warning">no class assigned</small>';
	}

	public function role_(){
		return $this->role_id !== null && $this->role_id > 0 ? '<a href="'.route('role.show',[$this->role->id]).'">'.$this->role->name.'</a>': '<small class="text-danger">no role yet</small>';
	}
}

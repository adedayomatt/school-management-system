<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Enrollment extends Model
{
    use SoftDeletes;
    use SearchableTrait;

	protected $dates=['deleted_at'];

	protected $fillable=[
                        'surname','other_names','dob','gender',
                         'former_sch','former_sch_class','nationality','state',
                        'lga', 'town', 'village', 'home_address',
                        'emergency_contact', 'emergency_phone', 'ailment',
                        'siblings','seeking_admission_into','admitted_into','parent_email'
                        ];
    protected $searchable = [
        'columns' => [
            'enrollments.surname' => 10,
            'enrollments.other_names' => 10 
        ],
        'joins' => [
            'parentts' => ['enrollments.id','parentts.enrollment_id'],
            'students' => ['enrollments.id','students.enrollment_id'],
            'classrooms' => ['classrooms.id','students.classroom_id']
        ]
        ];

    public function fullname(){
        return $this->surname.' '.$this->other_names;
    }

    public function passport(){
        $path = 'storage/students/passport/'.$this->passport;
        return $this->passport != null && file_exist(public_path($path)) ? asset($path) : asset('storage/students/passports/default.png');
    }
    public function admittedInto(){
        $class = Classroom::find($this->admitted_into);
        if($class == null){
            return "Nil";
        }
        return '<a href="'.route('class.show',[$class->id]).'">'.$class->name.'</a>';
    }

    public function created_at(){
        return $this->created_at->toDayDateTimeString().', '.$this->created_at->diffForHumans();
    }

    public function deleted_at(){
        return $this->deleted_at->toDayDateTimeString().', '.$this->deleted_at->diffForHumans();
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
    public function student(){
        return $this->hasOne('App\Student');
    }
    
	public function parents(){
		return $this->hasMany('App\Parentt');
    }

    public function isApproved(){
        return $this->student === null ? false : true;
    }
    
}

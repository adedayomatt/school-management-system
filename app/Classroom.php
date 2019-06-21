<?php

namespace App;

use App\StudentAttendance;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable=['name','slug'];
	
	public function students(){
		return $this->hasMany('App\Student');
	}

	public function staff(){
		return $this->hasMany('App\Staff');
	}
	
	public function attendances(){
        return $this->hasMany('App\StudentAttendance');
    }

	public function subjects()
    {
        return $this->belongsToMany('App\Subject');
	}
	public function fees(){
		return $this->belongsToMany('App\Fee');
	}
    public function results(){
        return $this->hasMany('App\Result');
	}
	

	public function subjectsArray(){
        $subjects = array();
        foreach($this->subjects as $s)
        {
            array_push($subjects, $s->id);
        }
        return $subjects;
	}
	public function studentsArray(){
        $students = array();
        foreach($this->students as $s)
        {
            array_push($students, $s->id);
        }
        return $students;
    }

	public function isOffering($subject_id)
	{
		$subject = Subject::findorfail($subject_id);
		return in_array($subject->id,$this->subjectsArray()) ? true : false;
	}
	public function teachers(){
	    	$teachers = "";
		if($this->staff->count() > 0){
			foreach($this->staff as $stf){
				$teachers .= '<a href="'.route('staff.show',[$stf->id]).'" class="d-block"><i class="fa fa-user-tie"></i> '.$stf->fullname().'('.$stf->role->name.')</a> ';
			}
		}
		else{
			$teachers = '<small class="text-danger">No teacher yet</small>';
		}
		return $teachers;
	}

// Check if attendance is marked for a particular date
	public function attendanceMarked($date){
		$attendances = StudentAttendance::whereDate('created_at',$date)->where('classroom_id',$this->id)->get();
		return $attendances->count() > 0 ? true :false;
	}
// check if attendance is marked today
	public function attendanceMarkedToday(){
		return $this->attendanceMarked(now()->format('Y-m-d'));
	}


}

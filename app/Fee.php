<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['term_id','name','description','ammount','general'];

    public function term(){
        return $this->belongsTo('App\Term');
    }
    public function payments(){
        return $this->hasMany('App\Payment');
    }
    
    public function classrooms(){
        return $this->belongsToMany('App\Classroom');
    }
    
    public function students(){
        return $this->belongsToMany('App\Student');
    }

    public function classroomsArray(){
        $classes = array();
        foreach($this->classrooms as $c)
        {
            array_push($classes, $c->id);
        }
        return $classes;
    }

    public function studentsArray(){
        $students = array();
        foreach($this->students as $c)
        {
            array_push($students, $c->id);
        }
        return $students;
    }


    public function isForClasses(){
        return $this->classrooms->count() > 0 ? true : false;
    }

    public function isForStudents(){
        return $this->students->count() > 0 ? true : false;
    }

    public function isForGeneral(){
        return $this->general == 1 ? true : false;
    }

// check if a student is eligible to pay the fee
    public function payableByStudent($student_id){
        $student = Student::findorfail($student_id);
        if(in_array($student->id, $this->studentsArray())){
            return true;
        }
        return false;

    }
    // check if a class is eligible to pay the fee
    public function payableByClass($class_id){
        $class = Classroom::findorfail($class_id);
        if(in_array($class->id, $this->classroomsArray())){
            return true;
        }
        return false;
    }


    public function target()
    {
        if($this->isForStudents()){
            $target = '';
            foreach($this->students as $student){
                $target .= '<a href="'.route('student.show',[$student->id]).'">'.$student->fullname().'</a>, ';
            }
            return $target;
        }
        elseif($this->isForClasses()){
            $target = '';
            foreach($this->classrooms as $classroom){
                $target .= '<a href="'.route('class.show',[$classroom->id]).'">'.$classroom->name.'</a>, ';
            }
            return $target;
        }
        elseif($this->isForGeneral()){
            return "All students";
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['term_id','name','description','ammount','target'];

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

    public function totalPaid(){
        $paid = 0;
        foreach($this->payments as $payment){
            $paid += $payment->ammount;
        }
        return $paid;
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
        foreach($this->students as $s)
        {
            array_push($students, $s->id);
        }
        return $students;
    }


    public function isForClasses(){
        return $this->target == 'classes' ? true : false;
    }

    public function isForStudents(){
        return $this->target == 'students' ? true : false;
    }

    public function isForGeneral(){
        return $this->target == 'general' ? true : false;
    }

// check if a student is eligible to pay the fee
    public function payableByStudent($student_id){
        $student = Student::findorfail($student_id);
        if($this->isForGeneral() ||  in_array($student->id, $this->studentsArray()) || in_array($student->classroom->id, $this->classroomsArray())){
            return true;
        }
        return false;

    }
    // check if a class is eligible to pay the fee
    public function payableByClass($class_id){
        $class = Classroom::findorfail($class_id);
        if($this->isForGeneral() || in_array($class->id, $this->classroomsArray())){
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
        else{
            return '<small class="text-muted">target not specified</small>';
        }
    }
    public function debtors(){
        $debtors = array();
       foreach(Student::all() as $student){
           if($this->payableByStudent($student->id) && $student->balanceOf($this->id) > 0){
                array_push($debtors, ['student' => $student, 'balance' => $student->balanceOf($this->id)]);
           }
       }
       return collect($debtors);
    }
}

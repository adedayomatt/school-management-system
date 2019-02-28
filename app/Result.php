<?php

namespace App;

use App\Grade;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'term_id', 'student_id', 'subject_id', 'classroom_id', 'test', 'exam', 'remark'
    ];

    public function term(){
        return $this->belongsTo('App\Term');
    }
    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }
    public function total(){
        return $this->test + $this->exam;
    }
    public function grade(){
        $grades = Grade::all();
        $grade = 'X';
        foreach($grades as $g){
            if(in_array($this->total(),range($g->min,$g->max))){
                $grade = $g->alphabet;
            }
        }
        return $grade;
    }
}

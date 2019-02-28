<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $fillable = [
        'term_id','student_id', 'classroom_id','present','comment'
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }

    public function isPresent(){
        return $this->present == 1 ? true : false;
    }

}

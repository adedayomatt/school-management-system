<?php

namespace App\Http\Controllers;
use App\Staff;
use App\Classroom;
use App\Setting;
use App\StudentAttendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(){
       $this->middleware('teacher');
    }

    public function markStudentAttendance(Request $request,$classroom_id){
        $class = Classroom::findorfail($classroom_id);
       $markedStudents = !isset($request->students) ? array() : $request->students;

            $term = Setting::all()->first()->term;
            $count = 0;
            // Check if attendance has already been marked for today, just update
            if($class->attendanceMarked(now()->format('Y-m-d'))){
                foreach($class->students as $student){
                    $attendance = $student->attendance(now()->format('Y-m-d'));
                    $attendance->present = in_array($student->id,$markedStudents) ? 1 : 0;
                    $attendance->save();
                    if(in_array($student->id,$markedStudents)){
                        $count++;
                    }
                }
            }else{ //if attendance is not marked today, create it!
                foreach($class->students as $student){
                    StudentAttendance::create([
                        'term_id' => $term->id,
                        'student_id' => $student->id,
                        'classroom_id' => $class->id,
                        'present' => in_array($student->id,$markedStudents) ? 1 : 0
                    ]);
                    if(in_array($student->id,$markedStudents)){
                        $count++;
                    }
                }
            }

            return redirect()->route('class.show',[$class->id])->with('success',$count.' students marked as present');
        }
}

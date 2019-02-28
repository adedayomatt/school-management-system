<?php

namespace App\Http\Controllers;

use Auth;
use App\Term;
use App\Result;
use App\Student;
use App\Subject;
use App\Classroom;
use App\Setting;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(){
        $this->middleware('teacher')->except(
            'studentResults',
            'classResults'
        );
     }

    public function studentResults(){
        $t = request()->get('term');
        $s = request()->get('student');
      
        if($t != null && $s !=null){
            $term = Term::findorfail($t);
            $student = Student::findorfail($s);

            $results = Result::where('term_id',$term->id)
                                ->where('student_id',$student->id)
                                ->groupby('term_id')
                                ->get();
            return view('result.student')->with('results',$results)
                                            ->with('student',$student)
                                            ->with('term',$term);
            }
            return view('result.student');
    }


    public function classResults($class_id){
        $t = request()->get('term');
        $class = Classroom::findorfail($class_id);
        if($t == null){
            return view('result.class')->with('class',$class);
        }
        $term = Term::findorfail($t);
        $results = Result::where('term_id',$term->id)
                            ->where('classroom_id',$class->id)
                            ->groupby('student_id')
                            ->get();
                         
        return view('result.class')->with('results',$results)
                                    ->with('term',$term)
                                    ->with('class',$class);         
    }


    public function record($classroom_id,$subject_id){
        $class = Classroom::findorfail($classroom_id);
        $subject = Subject::findorfail($subject_id);
        $term = Setting::all()->first()->term;
        if(Auth::user()->profile->classroom->id != $class->id){
            return redirect()->route('dashboard')->with('warning','You are not authorized to record results for that class!');
        }
        
        return view('result.record')->with('class',$class)
                                    ->with('subject', $subject);
    }

    public function edit(){
        
    }
    public function save(Request $request,$classroom_id,$subject_id){
        $class = Classroom::findorfail($classroom_id);
        $subject = Subject::findorfail($subject_id);
        $term = $request->term;

    // Check if records have been entered before, just update
        foreach($class->students as $student){
            $result = $student->result($term,$subject->id);
            $testIndex = 'test_'.$student->id;
            $examIndex = 'exam_'.$student->id;
            if($result == null){
                Result::create([
                    'term_id' => $term,
                    'classroom_id' => $class->id,
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'test' => $request->$testIndex == null ? 0 : $request->$testIndex,
                    'exam' => $request->$examIndex == null ? 0 : $request->$examIndex
                ]);
            }
            else{
                $result->test = $request->$testIndex == null ? 0 : $request->$testIndex;
                $result->exam = $request->$examIndex == null ? 0 : $request->$examIndex;
                $result->save();
            }

        }
        return redirect()->back()->with('success','Results recorded for '.$subject->name);
    }
}

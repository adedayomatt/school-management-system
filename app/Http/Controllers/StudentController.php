<?php

namespace App\Http\Controllers;

use Session;
use App\Fee;
use App\Student;
use App\Classroom;
use App\Enrollment;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except([
            'find',
            'search',  
            'show'
          ]);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderby('created_at','desc')->paginate(20);
        return view('student.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($enrollment_id)
    {
        $enrollment = Enrollment::findorfail($enrollment_id);
        if($enrollment->isApproved()){
            return redirect()->back()->with('info',$enrollment->fullname().' is already admitted to '.$enrollment->student->classroom->name);
        }
        return view('student.create')->with('enrollment',$enrollment)
                                    ->with('classes',Classroom::all());
    }

    public function addFee(Request $request,$student_id){
        $this->validate($request, [
            'fee' => ['required']
        ]);
        $student = Student::findorfail($student_id);
        $fee = Fee::findorfail($request->fee);
        $fee->students()->attach($student->id);
        return redirect()->route('student.show',[$student->id])->with('success','Fee: '.$fee->name.'('.$fee->ammount.') added for '.$student->fullname());
    }

    public function cancelFee(Request $request,$student_id){
        $this->validate($request, [
            'fee' => ['required']
        ]);
        $student = Student::findorfail($student_id);
        $fee = Fee::findorfail($request->fee);
        $students = $fee->studentsArray();
        unset($students[array_search($student->id,$students)]);//remove the student id from the eleigible student to pay the fee
        $fee->students()->sync($students);//sync the fee with the new students array
       return redirect()->route('student.show',[$student->id])->with('success','Fee: '.$fee->name.' has been cancelled for '.$student->fullname());
    }

    public function payFee($student_id,$fee_id){
        $student = Student::findorfail($student_id);
        $fee = Fee::findorfail($fee_id);
        return view('payment.create')->with(['student' => $student,'fee' =>$fee]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$enrollment_id)
    {
        $enrollment = Enrollment::findorfail($enrollment_id);

        $this->validate($request,[
            'class' => ['required']
        ]);

        $student = Student::create([
            'enrollment_id' => $enrollment->id,
            'classroom_id' => $request->class
        ]);

        $enrollment->admitted_into = $request->class;
        $enrollment->save();
        
        return redirect()->route('student.show',[$student->id])->with('success',$student->enrollment->fullname().' admitted to '.$student->classroom->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('student.show')->with('student',$student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findorfail($id);
        return view('student.edit')->with('student',$student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'class' => ['class']
            ]);

        $student = Student::findorfail($id);
        $student->classroom_id = $request->class;
        $student->save();

        return redirect()->route('student.show',[$student->id])->with($student->enrollment->fullname().' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $student = Student::findorfail($id);
         $student->delete();
         return redirect()->route('student.index');
    }
}

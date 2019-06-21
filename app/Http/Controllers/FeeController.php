<?php

namespace App\Http\Controllers;

use DB;
use App\Fee;
use App\Classroom;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
     }    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fee::orderby('created_at','desc')->get();
        return view('fee.index')->with('fees',$fees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fee.create');
    }

    private function rules(){
        return [
            'fee_name' => ['required'],
            'term' => ['required'],
            'ammount' => ['required','numeric']
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());

        $fee  = Fee::create([
            'term_id' => $request->term,
            'name' => $request->fee_name,
            'description' => $request->fee_description,
            'ammount' => $request->ammount,
            'target' => $request->target,
        ]);
        
        if($request->target == 'classes'){
            $fee->classrooms()->attach($request->classes);
        }
        elseif($request->target == 'students'){
            $fee->students()->attach($request->students);
        }

        return redirect()->route('fee.index')->with('success','New Fee created '.($fee->classroom_id === null ? '': ' for '.$fee->classroom->name));
    }

    public function pay($fee){
        return view('payment.create',['fee' => Fee::findorfail($fee)]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fee = Fee::findorfail($id);
        return view('fee.show')->with('fee',$fee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee = Fee::findorfail($id);
        return view('fee.edit')->with('fee',$fee);
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
        $fee  = Fee::findorfail($id);
        $this->validate($request, $this->rules());

        $fee->name = $request->fee_name;
        $fee->description = $request->fee_description;
        $fee->term_id = $request->term;
        $fee->ammount = $request->ammount;
        $fee->target = $request->target;
        $fee->save();
        return redirect()->route('fee.show',[$fee->id])->with('success',$fee->name.($fee->classroom_id === null ? '': 'for '.$fee->classroom->name).' updated');
    }

    public function attachClasses(Request $request, $id){
        $fee = Fee::findorfail($id);
        if(!$fee->isForClasses()){
            return redirect()->back()->with('error', $fee->name.' is not meant for classes');
        }
        if($request->classrooms != null && count($request->classrooms) > 0){
            $fee->classrooms()->attach($request->classrooms);
            return redirect()->back()->with('success', count($request->classrooms).' classes attached to '.$fee->name);
        }
        return redirect()->back()->with('error', 'No class selected');
    }

    public function attachStudents(Request $request, $id){
        $fee = Fee::findorfail($id);
        if(!$fee->isForStudents()){
            return redirect()->back()->with('error', $fee->name.' is not meant for d students');
        }
        if($request->students != null && count($request->students) > 0){
                $fee->students()->attach($request->students);
                return redirect()->back()->with('success', count($request->students).' students attached to '.$fee->name);
        }
        return redirect()->back()->with('error', 'No student selected');
    }

    public function cancelStudentFee(Request $request,$student_id, $fee_id){
        $student = Student::findorfail($student_id);
        $fee = Fee::findorfail($fee_id);
        $students = $fee->studentsArray();
        unset($students[array_search($student->id,$students)]);//remove the student id from the eleigible student to pay the fee
        $fee->students()->sync($students);//sync the fee with the new students array
       return redirect()->route('student.show',[$student->id])->with('success','Fee: '.$fee->name.' has been cancelled for '.$student->fullname());
    }

    
    public function cancelClassFee(Request $request,$class_id, $fee_id){

        $class = Classroom::findorfail($class_id);
        $fee = Fee::findorfail($fee_id);
        $classes = $fee->classroomsArray();
        unset($classes[array_search($class->id,$classes)]);//remove the classroom id from the eleigible classes to pay the fee
        $fee->classrooms()->sync($classes);//sync the fee with the new classes array
       return redirect()->route('class.show',[$class->id])->with('success','Fee: '.$fee->name.' has been cancelled for '.$class->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee = Fee::findorfail($id);
         foreach($fee->payments as $payment){
            $payment->delete();
        }
        // DB::raw("DELETE FROM fee_student WHERE fee_id = $fee->id");
        // DB::raw("DELETE FROM classroom_fee WHERE fee_id = $fee->id");
        $fee->delete();
        return redirect()->route('fee.index')->with('success','Fee: '.$fee->name.($fee->classroom_id === null ? '': ' for '.$fee->classroom->name).' and payments cancelled');
    }
}

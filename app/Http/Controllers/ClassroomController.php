<?php

namespace App\Http\Controllers;

use Session;
use App\Student;
use App\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->except([
          'index',
          'show',
        ]);
     }

    public function getClassroom($id){
    if(is_numeric($id)){
        return Classroom::findorfail($id);
    }
    elseif(is_string($id)){
        return Classroom::where('slug',$id)->firstorfail();
    }
}
public function changeClass(Request $request){
    $this->validate($request,[
        'new_class' => ['required']
    ]);
    $class = $this->getClassroom($request->new_class);
    $count = 0;
    if(isset($request->students) && count($request->students) > 0){
        foreach($request->students as $id){
            $student = Student::find($id);
            if($student !== null){
                $student->classroom_id = $request->new_class;
                $student->save();
                $count++;
            }
        }
    }
    return redirect()->back()->with('success',$count.' students classes changed to '.$class->name);
}


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
   */
    public function index()
    {
        return view('class.index')->with('classes',Classroom::orderby('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
    }
    public function createFee($id){
        $class = Classroom::findorfail($id);
        return view('fee.create')->with('class',$class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
		]);

        $class = Classroom::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);

        $class->subjects()->sync($request->subjects);

		return redirect()->route('class.index')->with('success',$class->name.' added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('class.show')->with('class', $this->getClassroom($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('class.edit')->with('class', $this->getClassroom($id));
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

        $class = $this->getClassroom($id);

        $this->validate($request,[
			'name' => 'required'
		]);

		$class->name = $request->name;
		$class->slug = str_slug($request->name);
        $class->save();
        
        $class->subjects()->sync($request->subjects);

		return redirect()->route('class.show',[$class->id])->with('success','Class '.$class->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $class = $this->getClassroom($id);
        $class->delete();
        DB::raw("DELETE FROM classroom_subject WHERE classroom_id = $class->id");
		return redirect()->route('class.index')->with('success','Class '.$class->name.' deleted');
    }
}

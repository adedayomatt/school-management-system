<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->except([
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
        $subjects = Subject::all();
        return view('subject.index')->with('subjects',$subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');   
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
            'name' => 'required'
        ]);
        
        $subject = Subject::create([
            'name' => $request->name
        ]);
        $subject->classrooms()->attach($request->classes);


        return redirect()->route('subject.index')->with('success','New subject '.$request->name.' added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findorfail($id);
        return view('subject.show')->with('subject',$subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findorfail($id);
        return view('subject.edit')->with('subject',$subject);
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
            'name' => 'required'
        ]);

       $subject = Subject::findorfail($id);
       $subject->name = $request->name;
       $subject->save();

       $subject->classrooms()->sync($request->classes);

        return redirect()->route('subject.index')->with('success','Subject '.$request->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findorfail($id);
        $subject->delete();
        DB::raw("DELETE FROM classroom_subject WHERE subject_id = $subject->id");
        return redirect()->route('subject.index')->with('success','Subject '.$request->name.' deleted');
    }
}

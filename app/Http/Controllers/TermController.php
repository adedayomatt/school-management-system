<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('term.index')->with('terms',Term::orderby('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('term.create');
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
            'academic_session' => ['required'],
            'term' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date']
        ]);

        $term = Term::create([
            'session' => $request->academic_session,
            'term' => $request->term,
            'start' => $request->start,
            'end' => $request->end
        ]);

        return redirect()->route('term.index')->with('success','New academic term '.$term->session.' ('.$term->term().') added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('term.show')->with('term',Term::findorfail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('term.edit')->with('term',Term::findorfail($id));
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'academic_session' => ['required'],
            'term' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date']
        ]);

        $term = Term::findorfail($id);
        $term->session = $request->academic_session;
        $term->term = $request->term;
        $term->start = $request->start;
        $term->end = $request->end;

        $term->save();

        return redirect()->route('term.show',[$term->id])->with('success',$term->session.' ('.$term->term().') updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

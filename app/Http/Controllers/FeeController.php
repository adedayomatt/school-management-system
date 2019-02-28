<?php

namespace App\Http\Controllers;

use DB;
use App\Fee;
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
            'general' => $request->target == 'general' ? 1 : 0,
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

        $fee->save();
        return redirect()->route('fee.show',[$fee->id])->with('success',$fee->name.($fee->classroom_id === null ? '': 'for '.$fee->classroom->name).' updated');
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

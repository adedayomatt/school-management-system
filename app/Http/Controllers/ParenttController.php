<?php

namespace App\Http\Controllers;

use App\Student;
use App\Parentt;
use App\Enrollment;
use Illuminate\Http\Request;

class ParenttController extends Controller
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
        $parents = Parentt::orderby('created_at','desc')->paginate(20);
        return view('parent.index')->with(['parents'=>$parents,'total'=>Parentt::all()->count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($enrollment_id)
    {
     $enrollment = Enrollment::findorfail($enrollment_id);
     return view('parent.create')->with('enrollment',$enrollment);   
    }

    private function rules(){
        return [
            'fullname' => ['required','string'],
            // 'relation' => ['required','string'],
            // 'phone' => ['required'],
            // 'home_address' => ['required','string'],
            // 'occupation' => ['required','string'],
            // 'business_address' => ['required','string'],
        ];
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

        $this->validate($request, $this->rules());

        $parent = Parentt::create([
            'enrollment_id' => $enrollment->id,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'home_address' => $request->address,
            'relation' => $request->relation === 'other' ? $request->other_relation : $request->relation,
            'occupation' => $request->occupation,
            'business_address' =>$request->business_address
        ]);
        
       
        return redirect()->route('enrollment.show',[$enrollment->id])->with('success','Parent added to '.$parent->enrollment->fullname());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = Parentt::findorfail($id);
        return view('parent.show')->with('parent',$parent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent = Parentt::findorfail($id);
        return view('parent.edit')->with('parent',$parent);
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

        $this->validate($request,$this->rules());


        $parent = Parentt::findorfail($id);
        $parent->fullname = $request->fullname;
        $parent->relation = $request->relation == 'other' ? $request->other_relation : $request->relation;
        $parent->phone = $request->phone;
        $parent->home_address = $request->address;
        $parent->occupation = $request->occupation;
        $parent->business_address = $request->business_address;

        $parent->save();

        return redirect()->route('enrollment.show',[$parent->enrollment->id])->with('success','Parent details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = Parent::findorfail($id);
        $parent->delete();

        return redirect()->route('parent.index')->with('success','Parent for '.$parent->student.' deleted');

    }
}

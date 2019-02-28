<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;

class FineController extends Controller
{
     public function __construct()
    {
        //   $this->middleware('auth');
    }

    public function index(){
        $fines = Fine::orderby('created_at','desc')->get();
        return view('fine.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($staff_id){

        $staff = Staff::findOrFail($staff_id);
		return view('fine.create')->with('staff',$staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $staff_id){

        $staff = Staff::findOrFail($staff_id);

	    $fine = Fine::create([
            'staff_id' => $staff_id,
            'ammount' => $request->ammount,
            'reason' => $request->reason
		]);

		return redirect()->route('fine.index')->with('success','New fine added for '.$staff->fullname());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $fine = Fine::findorfail($id);
        return view('fine.edit')->with('fine',$fine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $staff_id,$id)
    {
        
        $staff = Staff::findOrFail($staff_id);
        $fine = Fine::findorfail($id);

        $fine->staff_id = $staff_id;
        $fine->ammount = $request->ammount;
        $fine->reason = $request->reason;
	    $fine->save();

		return redirect()->route('fine.show',[$fine->id])->with('success','Fine updated for '.$staff->fullname());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fine=Fine::findOrFail($id);
		$fine->delete();
		return redirect()->back()->with('success','Fine Deleted');
    }


	public function bin(){
		$fines=Payroll::onlyTrashed()->get();
		return view('fine.bin')->with('fines', $payrolls);
	}

	public function restore($id){
		$fines=Fine::withTrashed()->where('id', $id)->first();
		$fine->restore();

		return redirect()->route('fines.index')->with('success','fine restored');
	}

	public function kill($id){
		$fine=Fine::withTrashed()->where('id', $id)->first();
		$fine->forceDelete();
		return redirect()->route('fine.index')->with('success','fine deleted permanently');
	}
}

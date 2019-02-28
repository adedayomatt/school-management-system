<?php

namespace App\Http\Controllers;
use App\Staff;
use App\Guarantor;
use Illuminate\Http\Request;

class GuarantorController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($staff_id)
    {
        $staff = Staff::findorfail($staff_id);
        return view('staff.guarantor.create')->with('staff',$staff);

    }

    private function rules(){
        return [
            'surname' => ['required','string'],
			'other_names' => ['required','string'],
            // 'gender' => ['required'],
            // 'marital_status' => ['required'],
            // 'phone' => ['required'],
            // 'email' => ['required','email'],
            // 'nationality' => ['required'],
            // 'home_address' => ['required'],
            // 'business_address' => ['required'],
            // 'employer' => ['required'],
            // 'years_with_employer' => ['required','numeric']
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$staff_id)
    {
        $staff = Staff::findorfail($staff_id);
        $this->validate($request, $this->rules());

        $guarantor = Guarantor::create([
            'staff_id' => $staff->id,
            'surname' => $request->surname,
            'other_names' => $request->other_names,
			'gender' => $request->gender,
			'marital_status' => $request->marital_status,
			'phone' => $request->phone,
			'email' => $request->email,
			'nationality' => $request->nationality,
			'home_address' => $request->home_address,
			'business_address' => $request->business_address,
			'employer' => $request->employer,
			'years_with_employer' => $request->years_with_employer
        ]);

        return redirect()->route('staff.show',[$staff->id])->with('success', 'Guarantor added to '.$staff->fullname());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($staff,$id)
    {
        $guarantor = Guarantor::findorfail($id);
        return view('staff.guarantor.edit')->with('guarantor',$guarantor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $staff, $id)
    {
        $guarantor = Guarantor::findorfail($id);
        
        $guarantor->surname = $request->surname;
		$guarantor->other_names = $request->other_names;
		$guarantor->gender = $request->gender;
		$guarantor->marital_status = $request->marital_status;
		$guarantor->phone = $request->phone;
        $guarantor->email = $request->email;
        $guarantor->nationality = $request->nationality;
        $guarantor->home_address = $request->home_address;
        $guarantor->business_address = $request->business_address;
        $guarantor->employer = $request->employer;
        $guarantor->years_with_employer = $request->years_with_employer;

        $guarantor->save();

        return redirect()->route('staff.show',[$guarantor->staff->id])->with('success','Guarantor updated');
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

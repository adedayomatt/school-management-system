<?php

namespace App\Http\Controllers;

use App\Role;
use App\Staff;
use App\Classroom;
use App\Guarantor;
use Illuminate\Http\Request;

class StaffController extends Controller
{
	 public function __construct()
    {
          $this->middleware('admin')->except([
            'find',
            'search',  
            'show'
          ]);
    }

    public function find($keyword){
        return Staff::search($keyword)
                        ->with('role')
                        ->with('classroom')
                        ->get();
    }
// For typeahead
    public function search(Request $request){
        return $this->find($request->get('q'));
    }
// For displaying the result on a page
    public function searchResult(Request $request){
        $keyword = $request->get('q');
        if($keyword  !== null)
        {
            return view('staff.search')
                    ->with('keyword',$keyword)
                    ->with('staffs',$this->find($keyword));
        }
        return view('staff.search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.index')->with('staffs',Staff::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create')->with(['roles'=>Role::all(),'classes' => Classroom::all()]);
    }

    private function rules(){
        return [
            'surname' => ['required','string'],
			'other_names' => ['required','string'],
            'gender' => ['required'],
            // 'date_of_birth' => ['required'],
            // 'marital_status' => ['required'],
            // 'phone' => ['required'],
            // // 'email' => ['required','email'],
            // 'first_appointment' => ['required'],
            // 'nationality' => ['required'],
            // 'state_of_origin' => ['required'],
            // 'lga' => ['required'],
            // 'town' => ['required'],
            // 'village' => ['required'],
            // 'permanent_address' => ['required','string'],
            // 'residential_address' => ['required','string'],
			// 'emergency_contact' => ['required'],
			// 'role' => ['required']
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
        $this->validate($request,$this->rules());

		 $staff = Staff::create([
            'surname' => $request->surname,
            'other_names' => $request->other_names,
            'gender' => $request->gender,
            'dob' => $request->date_of_birth,
			'marital_status' => $request->marital_status,
			'phone' => $request->phone,
			'email' => $request->email,
			'first_appointment' => $request->first_appointment,
			'nationality' => $request->nationality,
			'state' => $request->state_of_origin,
			'lga' => $request->lga,
			'town' => $request->town,
			'village' => $request->village,
			'permanent_address' => $request->permanent_address,
			'residential_address' => $request->residential_address,
			'emergency_contact' => $request->emergency_contact,
			'role_id' => $request->role,
			'classroom_id' => $request->class,
		]);


		return redirect()->route('guarantor.create',[$staff->id])->with('success','New staff added, Next is the guarantor information');
    }

        public function assignClass(Request $request, $id){
        $staff = Staff::findorfail($id);
        $this->validate($request,['class' => ['required']]);
        
        $class = Classroom::findorfail($request->class);
        if(!$staff->isTeacher() && !$staff->isAsstTeacher()){
            return redirect()->back()->with('warning',"Cannot assign class to ".$staff->fullname().". This staff is neither a teacher nor asst. teacher");
        }
        $staff->classroom_id = $request->class;
        $staff->save();
        return redirect()->route('class.show',[$class->id])->with('success','Class '.$class->name.' assigned to '.$staff->surname.' as '.$staff->role->name);
    } 

public function changeRole(Request $request, $id){
    $staff = Staff::findorfail($id);
    $this->validate($request,['role' => ['required']]);
    $role = Role::findorfail($request->role);

    $staff->role_id = $request->role;
    if($request->role == 1){
        $staff->classroom_id = null;
    }
    $staff->save();

    return redirect()->route('staff.show',[$staff->id])->with('success',$staff->fullname().'\'s role updated to '.$staff->role->name);
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$staff = Staff::findorfail($id);
        return view('staff.show')->with('staff',$staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::findorfail($id);
        return view('staff.edit')->with('staff',$staff)
                                ->with('roles',Role::all())
                                ->with('classes', Classroom::all());
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

        $staff = Staff::findorfail($id);
        

        $staff->surname = $request->surname;
		$staff->other_names = $request->other_names;
        $staff->gender = $request->gender;
        $staff->dob = $request->date_of_birth;
		$staff->marital_status = $request->marital_status;
		$staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->first_appointment = $request->first_appointment;
        $staff->nationality = $request->nationality;
        $staff->state = $request->state_of_origin;
        $staff->lga = $request->lga;
        $staff->town = $request->town;
        $staff->village = $request->village;
        $staff->permanent_address = $request->permanent_address;
        $staff->residential_address = $request->residential_address;
        $staff->emergency_contact = $request->emergency_contact;
        
		$staff->save();

		return redirect()->route('staff.show',[$staff->id])->with('success',$staff->fullname().' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        if($staff->guarantor != null){
            $staff->guarantor->delete();
        }
		$staff->delete();
		return redirect()->route('staff.index')->with('success',$staff->fullname().' deleted');
    }

	public function bin(){
		$staffs = Staff::onlyTrashed()->get();
		return view('staff.bin')->with('staffs', $staffs);
	}

	public function restore($id){
		$staff = Staff::withTrashed()->where('id', $id)->firstorfail();
		$staff->restore();
		return redirect()->route('staff.index')->with('success','Staff '.$staff->fullname().' restored');
	}

	public function kill($id){
		$staff = Staff::withTrashed()->where('id', $id)->firstorfail();
		foreach($staff->payrolls as $payroll):
			$payroll->delete();
		endforeach;

		$staff->forceDelete();
		return redirect()->route('staff.index')->with('success','Staff '.$staff->fullname().' permanently deleted');
	}
}

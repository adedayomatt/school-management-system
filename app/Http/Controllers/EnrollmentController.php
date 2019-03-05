<?php

namespace App\Http\Controllers;

use Session;
use App\Student;
use App\Parentt;
use App\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->except([
          'find',
          'search',
          'show'
        ]);
     }

    public function find($keyword){
        return Enrollment::search($keyword)
                        ->with('student')
                        ->with('parents')
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
            return view('student.enrollment.search')
                    ->with('keyword',$keyword)
                    ->with('enrollments',$this->find($keyword));
        }
        return view('student.enrollment.search');
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        $pending_enrollments = array();
          foreach($enrollments as $e){
              if(!$e->isApproved()){
                  array_push($pending_enrollments,$e);
              }
          }
        return view('student.enrollment.index')->with('enrollments', collect($pending_enrollments)->sortByDesc('created_at'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.enrollment.create');
    }

    private function rules(){
        return [
            'surname' => ['required','string'],
            'other_names' => ['required','string'],
            // 'date_of_birth' => ['required','date'],
            // 'gender' => ['required','string'],
            // 'nationality' => ['required','string'],
            // 'state' => ['required','string'],
            // 'lga' => ['required','string'],
            // 'town' => ['required','string'],
            // 'village' => ['required','string'],
            // 'home_address' => ['required','string'],
            // 'emergency_contact' => ['required','string'],
            // 'emergency_phone' => ['required','string'],
            // 'seeking_admission_into' => ['required']
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

        $enrollment = new Enrollment();

        $enrollment->surname = $request->surname;
        $enrollment->other_names = $request->other_names;
        $enrollment->dob = $request->date_of_birth;
        $enrollment->gender = $request->gender;
        $enrollment->former_sch = $request->former_school;
        $enrollment->former_sch_class = $request->former_school_class;
        $enrollment->nationality = $request->nationality;
        $enrollment->state = $request->state;
        $enrollment->lga = $request->lga;
        $enrollment->town = $request->town;
        $enrollment->village = $request->village;
        $enrollment->home_address = $request->home_address;
        $enrollment->emergency_contact = $request->emergency_contact;
        $enrollment->emergency_phone = $request->emergency_phone;
        $enrollment->ailment = $request->ailment;
        $enrollment->siblings = $request->siblings;
        $enrollment->seeking_admission_into = $request->seeking_admission_into;

        $enrollment->save();

        Session::flash('enrollment','true');
        return redirect()->route('parent.create',[$enrollment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enrollment =Enrollment::findorfail($id);
        return view('student.enrollment.show')->with('enrollment',$enrollment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findorfail($id);
        return view('student.enrollment.edit')->with('enrollment',$enrollment);
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

        $enrollment =Enrollment::findorfail($id);

        $enrollment->surname = $request->surname;
        $enrollment->other_names = $request->other_names;
        $enrollment->dob = $request->date_of_birth;
        $enrollment->gender = $request->gender;
        $enrollment->former_sch = $request->former_school;
        $enrollment->former_sch_class = $request->former_school_class;
        $enrollment->nationality = $request->nationality;
        $enrollment->state = $request->state;
        $enrollment->lga = $request->lga;
        $enrollment->town = $request->town;
        $enrollment->village = $request->village;
        $enrollment->home_address = $request->home_address;
        $enrollment->emergency_contact = $request->emergency_contact;
        $enrollment->emergency_phone = $request->emergency_phone;
        $enrollment->ailment = $request->ailment;
        $enrollment->siblings = $request->siblings;
        $enrollment->seeking_admission_into = $request->seeking_admission_into;

        $enrollment->save();

        return redirect()->route('enrollment.show',[$enrollment->id])->with('success',$enrollment->fullname().' enrollment updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $enrollment = Enrollment::findorfail($id);

         if($enrollment->isApproved()){
            $enrollment->student->delete();
            }

        if($enrollment->parents->count() > 0){
            foreach($enrollment->parents as $p){
                $p->delete();
            }
        }

         $enrollment->delete();
         return redirect()->route('enrollment.index')->with('success',$enrollment->fullname().' enrollment has been deleted');
    }

    
	public function bin(){
		$enrollments = Enrollment::onlyTrashed()->orderBy('deleted_at','desc')->get();
		return view('student.enrollment.bin')->with('enrollments', $enrollments);
    }
    public function batchAction(Request $request)
    {
        switch($request->action)
        {
            case 1:
                $response = $this->batchRestore($request);
                return redirect()->route('enrollment.bin')->with($response);
            break;
            case 2:
                $response = $this->batchKill($request);
                return redirect()->route('enrollment.bin')->with($response);
            break;
        }
    }

	public function restore($id){
        $enrollment=Enrollment::withTrashed()->where('id', $id)->firstorfail();
        $enrollment->restore();

        $student = Student::withTrashed()->where('enrollment_id',$enrollment->id)->first();
        if($student != null){
            $student->restore();
        }

        $parents = Parentt::withTrashed()->where('enrollment_id',$enrollment->id)->get();
        if($parents->count() > 0){
            foreach($parents as $p){
                $p->restore();
            }
        }
    }

    public function singleRestore($id)
    {
        $this->restore($id);
		return redirect()->route('enrollment.bin')->with('success','enrollment restored');
    }

    public function batchRestore($request){
       if(!isset($request->enrollments) || count($request->enrollments) < 0){
		return ['error'=>'No enrollment is selected for restoration'];
       }
        $count = 0;
        foreach($request->enrollments as $e){
            $this->restore($e);
            $count++;
        }
		return ['success'=>$count.' enrollment restored'];
    }

	public function kill($id){
        $enrollment=Enrollment::withTrashed()->where('id', $id)->firstorfail();
        
        $student = Student::withTrashed()->where('enrollment_id',$enrollment->id)->first();
        if($student != null){
            $student->forceDelete();
        }

        $parents = Parentt::withTrashed()->where('enrollment_id',$enrollment->id)->get();
        if($parents->count() > 0){
            foreach($parents as $p){
                $p->forceDelete();
            }
        }

        $enrollment->forceDelete();

    }

    public function singleKill($id){
        $this->kill($id);
		return redirect()->route('enrollment.bin')->with('success','enrollment deleted permanently');
    }

    public function batchKill($request){
        if(!isset($request->enrollments) || count($request->enrollments) < 0){
            return ['error'=>'No enrollment is selected for delete'];
        }
            $count = 0;
            foreach($request->enrollments as $e){
                $this->kill($e);
                $count++;
            }
        return ['success'=> $count.' enrollments deleted permanently'];
    }
}

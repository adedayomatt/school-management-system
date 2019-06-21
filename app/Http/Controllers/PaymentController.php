<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Payment;
use App\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        $payments = Payment::orderby('created_at','desc')->paginate(20);
        return view('payment.index')->with('payments',$payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
    }

    private function rules(){
        return [
            'fee' => ['required'],
            'student' => ['required'],
            'ammount' => ['required', 'numeric']
        ];
    }
    private function generateRef(){
        $ref = substr(sha1(time()+rand(1000,99999)),5,7);
        if(Payment::where('ref',$ref)->count() > 0){
            $this->generateRef();
        }
        return $ref;
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

        $student = Student::findorfail($request->student);
        $fee = Fee::findorfail($request->fee);

        if(!$student->canPay($fee->id)){
            return redirect()->route('fee.show',[$fee->id])->with('warning', $student->fullname()." is not eligible to pay the fee issued to ".$fee->target());
        }

        $payment  = Payment::create([
            'fee_id' => $request->fee,
            'student_id' => $request->student,
            'ref' => $this->generateRef(),
            'ammount' => $request->ammount,
            'balance' => $student->balanceOf($fee->id) - $request->ammount
        ]);

        return redirect()->route('fee.show',[$payment->fee->id])->with('success','Payment of '.$payment->ammount.' for '.$payment->fee->title.' for '.$payment->student->fullname().' approved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ref)
    {
        $payment = Payment::where('ref',$ref)->firstorfail();
        return view('payment.show')->with('payment',$payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ref)
    {
        $payment = Payment::where('ref',$ref)->firstorfail();
        return view('payment.edit')->with('payment',$payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ref)
    {
        $payment = Payment::where('ref',$ref)->firstorfail();
        $this->validate($request, $this->rules());

        $payment->ammount = $request->ammount;
        $payment->balance = $payment->fee->ammount - $request->ammount;

        return redirect()->route('payment.show',[$payment->id])->with('success',$payment->student->fullname().'\'s payment for '.$payment->title.' updated');
    }
    public function verify(Request $request){
        $ref = $request->get('ref');
        if($ref != null){
            $payment = Payment::where('ref', $ref)->first();
            return view('payment.verify')->with('payment', $payment)
                                        ->with('ref',$ref);
        }
        return view('payment.verify');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findorfail($id);
        $payment->delete();
        return redirect()->route('fee.show',[$payment->fee->id])->with('success',$payment->student->fullname().'\'s payment of '.$payment->ammount.' for '.$payment->fee->name.' deleted');
    }
}

<?php
namespace App\Http\Controllers;

use PDF;
use App\Term;
use App\Student;
use App\Result;
use App\Payment;

use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function receipt($ref){
        $payment = Payment::where('ref',$ref)->firstorfail();
        $pdf = PDF::loadView('pdf.receipt',['payment'=>$payment]);
        return $pdf->stream('receipt.pdf');
    }

    public function result(Request $request){
        $t = $request->term;
        $s = $request->student;
        if($t != null && $s != null){

            $term = Term::findorfail($t);
            $student = Student::findorfail($s);

            $results = Result::where('term_id',$term->id)
                                ->where('student_id',$student->id)
                                ->get();
            if($results != null){
                $pdf = PDF::loadView('pdf.result',[
                    'term'=>$term,
                    'student'=>$student,
                    'results'=>$results
                    ]);
                    
                return $pdf->stream('result.pdf');
                }
                return redirect()->back()->with('error','No result found for '.$student->fullname().' in '.$term->session.', '.$term->term());
            }
            return redirect()->back()->with('error','invalid result request');
    }
}

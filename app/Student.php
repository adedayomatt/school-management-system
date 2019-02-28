<?php

namespace App;

use App\Result;
use App\StudentAttendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{
    use SoftDeletes;

	protected $dates=['deleted_at'];

	protected $fillable=[
                        'enrollment_id','user_id','classroom_id'
                        ];

    public function enrollment(){
        return $this->belongsTo('App\Enrollment');
    }

    public function fullname(){
        return $this->enrollment->fullname();
    }

    public function user(){
		return $this->belongsTo('App\User');
	}
                    
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }

    public function fees(){
        return $this->belongsToMany('App\Fee');
    }
    public function payments(){
        return $this->hasMany('App\Payment');
    }
    public function attendances(){
        return $this->hasMany('App\StudentAttendance');
    }
    public function results(){
        return $this->hasMany('App\Result');
    }
    
    public function allResults(){
        return Result::where('student_id',$this->id)
                        ->groupby('term_id')
                        ->get();
    }

    public function result($term,$subject){
        $result =  Result::where('student_id',$this->id)
                        ->where('classroom_id',$this->classroom->id)
                        ->where('term_id',$term)
                        ->where('subject_id',$subject)
                        ->get()->first();

                return $result;
	}


    public function allFees(){
        $fees = collect([]);
        $generalFees = Fee::where('general',1)->get();
        $classroomFees = $this->classroom->fees;
        $individualFees = $this->fees;
        return $fees->merge($generalFees)
                    ->merge($classroomFees)
                    ->merge($individualFees)
                    ->sortByDesc('created_at');
    }

    // Returns total ammount paid for a particular fee
    public function aggregatePayment($fee_id){
        $fee = Fee::findorfail($fee_id);
        $total_paid = 0;
        foreach($fee->payments()->where('student_id',$this->id)->get() as $payment)
        {
            $total_paid += $payment->ammount;
        }
        return $total_paid;
    }

    // Outstanding balance of a particular fee
    public function balanceOf($fee_id)
    {
        $fee = Fee::findorfail($fee_id);
        return $fee->ammount - $this->aggregatePayment($fee_id);
    }
// check if a student is eligible to pay a particular fee
    public function canPay($fee_id){
        $fee = Fee::findorfail($fee_id);
        // if student is eligible or his/her class is eligible 
        if($fee->isForGeneral() || $fee->payableByStudent($this->id) || $fee->payableByClass($this->classroom->id)){
            return true;
        }
        return false;
    }

    // returns attendance for a particular day

    public function attendance($date){
        
        return StudentAttendance::whereDate('created_at',$date)->where('student_id',$this->id)->first();
    }
    
    
}

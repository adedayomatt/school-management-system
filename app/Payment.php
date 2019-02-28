<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['ref','student_id','fee_id','ammount','balance'];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    
    public function fee(){
        return $this->belongsTo('App\Fee');
    }
    
    public function payable(){
        $prevPayments = $this->student->payments()
                                    ->where([['fee_id',$this->fee->id],['id','!=',$this->id]])
                                    ->where('created_at', '<',$this->created_at)
                                    ->orderby('created_at','desc')
                                    ->get();//check for the balance as at the last payment
        if($prevPayments->count() > 0)
        {
            return $prevPayments->first()->balance;
        }
        return $this->fee->ammount;

    }

    public function aggregatePayment(){
        $total_paid = 0;
        foreach($this->fee->payments as $payment)
        {
            $total_paid += $payment->ammount;
        }
        return $total_paid;
    }

    public function balance(){
        return $this->fee->ammount - $this->aggregatePayment();
    }
}

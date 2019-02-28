<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    protected $fillable = [
        'staff_id','present','comment'
    ];

    public function staff(){
        return $this->belongsTo('App\Staff');
    }
}

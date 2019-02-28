<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=[
        'name'
    ];

    public function classrooms()
    {
        return $this->belongsToMany('App\Classroom');
    }
    public function results(){
        return $this->hasMany('App\Result');
	}

}

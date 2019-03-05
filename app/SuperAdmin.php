<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone', 'email', 
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function fullname(){
        return $this->name;
    }
    
    public function isLevel1(){
        return $this->level == 1 ? true : false;
    }

    public function isLevel2(){
        return $this->level == 2 ? true : false;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $dates = ['start','end'];
    
    protected $fillable = ['session','term','start','end'];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }
    public function results(){
        return $this->hasMany('App\Result');
	}
    
    public function term(){
        switch($this->term){
            case 1:
                return  'First Term';
            break;
            case 2:
                return  'Second Term';
            break;
            case 3:
                return  'Third Term';
             break;
        }
    }

}

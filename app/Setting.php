<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function term(){
        return $this->belongsTo('App\Term');
    }

 
    public function currentTerm(){
        return $this->term->session."<sup>".$this->term->term()."</sup>";
    }
}

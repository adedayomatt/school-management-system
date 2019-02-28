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
}

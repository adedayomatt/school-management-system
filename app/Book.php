<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $fillable = [
        'title', 'author', 'classroom_id', 'stock'
    ];

    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }


}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','password','status','avatar'
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        switch($this->status){
            case 'superadmin':
                return $this->hasOne('App\SuperAdmin');
            break;

            case 'staff':
                return $this->hasOne('App\Staff');
            break;
            case 'parent':
                return $this->hasOne('App\Parentt');
            break;

        }
    }

    public function hasAccess(){
        return $this->access == 1 ? true : false;
    }

    public function isSuperAdmin(){
        return $this->status == 'superadmin' ? true : false;
    }

    public function isAdmin(){
        return $this->isSuperAdmin() || ($this->status == 'staff' && $this->profile->isAdmin()) ? true : false;
    }

    public function isTeacher(){
        return $this->status == 'staff' && $this->profile->isTeacher() ? true : false;
    }

    public function isAsstTeacher(){
        return $this->status == 'staff' && $this->profile->isAsstTeacher() ? true : false;
    }

}

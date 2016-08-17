<?php

namespace App;

use App\User;
use App\UserInvolvement;
use App\UserAlumniFamilyMember;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable
{
    use EntrustUserTrait;   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function involvement(){
        return $this->hasMany('App\UserInvolvement','user_id');
    }
     public function family(){
        return $this->hasMany('App\UserAlumniFamilyMember','user_id');
    }
}

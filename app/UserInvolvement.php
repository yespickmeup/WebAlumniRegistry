<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInvolvement extends Model
{

   public function user(){
   		return $this->belongsTo('App\User','user_id');
   }

}
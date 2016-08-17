<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public $fillable = ['title','description'];

}
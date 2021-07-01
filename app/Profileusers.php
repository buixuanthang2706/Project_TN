<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profileusers extends Model
{
    protected $table = "profile_users";
    public function profileusers(){
    	return $this->hasMany('App\User','user_id','id');
    }
}

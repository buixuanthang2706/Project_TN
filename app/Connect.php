<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    protected $table = "connect";
    public function users(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function job(){
    	return $this->belongsTo('App\Motelroom','job_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{


    public function client()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function mails()
    {
        return$this->belongsToMany('App\Mail')->withTimestamps();
    }
}

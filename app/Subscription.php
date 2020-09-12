<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public  function plan()
    {
        return $this->belongsTo('App\Plan','plan_id','id');
    }

    public  function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}

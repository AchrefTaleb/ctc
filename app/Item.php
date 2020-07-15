<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function digitals()
    {
        return $this->hasMany('App\Digital','item_id','id');
    }
}

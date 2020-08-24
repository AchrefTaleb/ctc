<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table="users";
    protected $guard_name = 'web'; // permisson
    protected $fillable = ['name','last_name','email','phone','password','adresse'];

    public function mails()
    {
        return $this->hasMany('App\Mail','user_id','id');
    }

    public function subscription()
    {
        return $this->hasOne('App\Subscription','user_id','id');
    }
}

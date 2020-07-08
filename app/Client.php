<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table="users";
    protected $guard_name = 'web'; // permisson
    protected $fillable = ['name','last_name','email','phone','password'];
}

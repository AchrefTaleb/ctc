<?php

namespace App;



class Staff extends User
{
    protected $table="users";
    protected $guard_name = 'web';
    protected $fillable = ['name','last_name','email','phone','password','adresse'];
}

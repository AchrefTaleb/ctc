<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ["code", "from", "user_id", "type", "category_mail_id", "description"];

    public function client()
    {
        return $this->belongsTo('App\Client','user_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\CategoryMail','category_mail_id','id');

    }

    public function items()
    {
        return $this->hasMany('App\Item','mail_id','id');
    }
}

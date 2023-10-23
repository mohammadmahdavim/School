<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KarnamehAdmin extends Model
{
    protected $guarded=[];

    public function dars()
    {
        return $this->belongsTo(dars::class,'dars_id','id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}


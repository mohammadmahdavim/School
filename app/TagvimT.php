<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagvimT extends Model
{

    protected $guarded = [];

    public function days()
    {

        return $this->belongsTo(Day::class, 'day')->withDefault();
    }

    public function times()
    {

        return $this->belongsTo(Time::class, 'time')->withDefault();
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function dars()
    {
        return $this->belongsTo(dars::class, 'dars_id')->withDefault();
    }
}

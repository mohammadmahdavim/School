<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patternItem extends Model
{
    protected $guarded=[];
    public function pattern()
    {
        return $this->belongsTo(pattern::class)->withDefault();
    }

    public function dars()
    {
        return $this->belongsTo(dars::class)->withDefault();
    }

    public function day()
    {
        return $this->belongsTo(Day::class)->withDefault();
    }

    public function status()
    {
        return $this->belongsTo(patternStatus::class)->withDefault();
    }

}

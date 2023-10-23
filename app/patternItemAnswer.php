<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patternItemAnswer extends Model
{
    protected $guarded=[];
    public function patternItem()
    {
        return $this->belongsTo(patternItem::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function dars()
    {
        return $this->belongsTo(dars::class)->withDefault();
    }
    public function statuss()
    {
        return $this->belongsTo(patternStatus::class,'status')->withDefault();
    }
}

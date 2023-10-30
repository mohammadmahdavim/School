<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherPresentDate extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function class()
    {
        return $this->belongsTo(clas::class,'class_id','id')->withDefault();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamClass extends Model
{
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(clas::class)->withDefault();
    }

    public function darsname()
    {
        return $this->belongsTo(dars::class,'dars_id','id')->withDefault();
    }

    public function exam(){
        return $this->belongsTo(Exam::class)->withDefault();
    }

}

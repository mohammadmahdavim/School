<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;
    protected $guarded=[];


    public function question()
    {
        $this->belongsTo(ExamQuestion::class)->withDefault();
    }

    public function answers()
    {
        $this->hasMany(ExamAnswer::class);
    }

    public function image()
    {
        $this->hasMany(OptionImage::class,'question_id','question_id');
    }

}

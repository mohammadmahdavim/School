<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dars extends Model
{
    protected $guarded = [];

    public function TotalMarks(){
        return  $this->hasMany(TotalMark::class,'coddars');
    }

    public function exams(){
        return  $this->hasMany(Exam::class);
    }

    public function teacher()
    {

        return $this->hasOne(teacher::class,'dars','id')->where('class_id',auth()->user()->class)->withDefault();
    }

    public function tagvim()
    {
        return $this->hasMany(TagvimS::class,'dars_id','id')->where('class_id',auth()->user()->class);
    }

    public function tagvimteacher()
    {
        return $this->hasMany(TagvimS::class,'dars_id','id');
    }


}

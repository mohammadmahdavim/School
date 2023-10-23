<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function exam()
    {
     return   $this->belongsTo(Exam::class)->withDefault();
    }

    public function myoptions()
    {
      return  $this->hasMany(Option::class,'question_id','id');
    }

    public function answers()
    {
      return  $this->hasMany(ExamAnswer::class);
    }

    public function useranswers()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        return  $this->hasMany(ExamAnswer::class,'question_id','id')->where('user_id',$iduser);
    }
    public function studentanswers()
    {

        return  $this->hasMany(ExamAnswer::class,'question_id','id');
    }

}

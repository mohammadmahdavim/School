<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;
    protected $table='myexams';
    protected $fillable = ['expire','author','title','status','expire','time','texprie','start','random'];

    public function users()
    {
        return $this->belongsTo(User::class,'author','id')->Withdefault(['f_name'=>'ندارد']);
    }

    public function questions()
    {
       return $this->hasMany(ExamQuestion::class);
    }

    public function marks()
    {
       return $this->hasMany(ExamMark::class);
    }

    public function mymarks()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        return $this->hasMany(ExamMark::class)->where('user_id',$iduser);
    }
    public function class()
    {
       return $this->belongsTo(clas::class)->withDefault();
    }

    public function darsname()
    {
       return $this->belongsTo(dars::class,'dars_id','id')->withDefault();
    }

    public function examclass()
    {
        return $this->hasMany(ExamClass::class);
    }

    public function finish()
    {
        return $this->hasMany(FinishExam::class);
    }

}

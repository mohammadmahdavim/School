<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tuition extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function student_pay_tuition()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        return $this->hasMany(PayTuition::class)->where('user_id',$iduser);
    }

    public function paytuition()
    {
        return $this->hasMany(PayTuition::class);
    }

    public function class()
    {
        return $this->belongsTo(clas::class)->withDefault();
    }
}

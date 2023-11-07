<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clas extends Model
{
    protected $guarded = [];

    public function tuition()
    {
        return $this->hasMany(Tuition::class,'class_id','id');
    }

    public function student()
    {
        return $this->hasMany(User::class,'class','classnamber')
            ->where('role','دانش آموز');

    }

    public function teacher_present()
    {
        return $this->hasMany(TeacherPresentDate::class,'class_id','id')->orderBy('updated_at','asc');
    }
}

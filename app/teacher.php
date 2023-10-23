<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $guarded=[];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id')->withdefault();
    }

    public function darss()
    {
        return $this->hasMany(dars::class,'id','dars');
    }
    public function class()
    {
        return $this->hasMany(clas::class,'classnamber','class_id');
    }

    public function tagvim()
    {
        return $this->hasMany(TagvimT::class,'class_id','class_id');

    }

}
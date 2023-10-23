<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamrin extends Model
{
    protected $guarded=[];

    public function users(){
        $this->belongsTo(User::class)->withDefault();
    }
    public function jtamrins(){
        $this->hasMany(JTamrin::class,'tamrin_id');
    }

    public function class()
    {
        return $this->belongsTo(clas::class, 'class_id', 'classnamber')->withDefault();
    }

    public function darss()
    {
        return $this->belongsTo(dars::class, 'dars', 'id')->withDefault();
    }
}

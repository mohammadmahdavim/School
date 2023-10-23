<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagvimS extends Model
{
    protected $table='tagvim_s';
    protected $guarded=[];



    public function days(){

        return $this->belongsTo(Day::class,'day')->withDefault();
    }
    public function times(){

        return $this->belongsTo(Time::class,'time')->withDefault();
    }

    public function dars(){
        return $this->belongsTo(dars::class,'dars_id')->withDefault();
    }
}

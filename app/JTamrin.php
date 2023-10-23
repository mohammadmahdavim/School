<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JTamrin extends Model
{
    protected $guarded = [];


    public function users(){
        $this->belongsTo(User::class,'id','usre_id')->withDefault();
    }

    public function tamrin(){
        $this->belongsTo(Tamrin::class,'id','tamrin_id')->withDefault();
    }


}

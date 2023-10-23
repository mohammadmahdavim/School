<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PAnswer extends Model
{
    protected $guarded = [];

    public function user(){
        return  $this->belongsTo(User::class)->withDefault();
    }

    public function answer(){
        return  $this->belongsTo(Answer::class)->withDefault();
    }
}

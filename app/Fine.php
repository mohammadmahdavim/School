<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $guarded = [];

    public function user(){
        return  $this->belongsTo(User::class)->withDefault();
    }
    public function library(){
        return  $this->belongsTo(Library::class,'library_id')->withDefault();
    }
}

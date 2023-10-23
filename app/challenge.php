<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class challenge extends Model
{
    protected $guarded = [];

    public function user(){
        return  $this->belongsTo(User::class)->withDefault();
    }
}

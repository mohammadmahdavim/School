<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayTuition extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function tuition(){
        return  $this->belongsTo(Tuition::class)->withDefault();
    }

    public function user(){
        return  $this->belongsTo(User::class)->withDefault();
    }
}

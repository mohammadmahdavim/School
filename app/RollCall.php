<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollCall extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'author')->withDefault();
    }
}

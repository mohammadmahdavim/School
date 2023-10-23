<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pattern extends Model
{

    protected $guarded=[];
    public function items()
    {
        return $this->hasMany(patternItem::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class)->withDefault();
    }


}

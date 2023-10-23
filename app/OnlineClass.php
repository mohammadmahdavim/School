<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineClass extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function author_class()
    {
      return  $this->belongsTo(User::class,'author')->withDefault();
    }

    public function day()
    {
        return $this->belongsTo(Day::class,'day_id')->withDefault();
    }
}

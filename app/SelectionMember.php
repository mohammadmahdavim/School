<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectionMember extends Model
{
    protected $guarded=[];

    public function selection()
    {
        return $this->belongsTo(Selection::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}

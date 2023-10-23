<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patternMemeberBlock extends Model
{
    public function pattern()
    {
        return $this->belongsTo(pattern::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

}

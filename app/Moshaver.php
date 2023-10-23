<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moshaver extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function comment(){
        return $this->hasMany(CommentMoshaver::class);
    }
}

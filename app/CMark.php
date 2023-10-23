<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMark extends Model
{
    protected $guarded = [];

    public function markitems(){

        return $this->hasMany(MarkItem::class,'item_id');
    }
}
